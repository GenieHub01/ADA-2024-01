<?php

class Opay extends CComponent
{
    const CURRENCY = 'GBP';

    private $clientId;
    private $clientSecret;
    private $apiUrl;

    public function init()
    {
        $this->clientId = 'AXYhg5qaWINdWaqzK5jGIV4ggLMxwMNVvBMRor5QgFHxTuZS4fPb3RO5JtPtnTkwziUCBRtRGuyAa5IV';
        $this->clientSecret = 'EIIVGegRgT-fMIZWZ_gH33hN7Mk8ftTDb1a076jGc1Nega5dYacfKadUKs603lRertfWDkKaENK7uqOq';
        $this->apiUrl = 'https://api.sandbox.paypal.com';
    }

    public function purchase($id)
    {
        $advert = Advert::model()->findByPk($id);
        if (!$advert) {
            throw new CHttpException(404, 'Advert not found');
        }

        $paylog = new Paylog();
        $paylog->user_id = $advert->user_id;
        $paylog->advert_id = $advert->id;
        $paylog->amount = $this->getAmount($advert->package);
        $paylog->description = $advert->payDescription;
        $paylog->active = 0;
        $paylog->save();

        $orderData = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => $paylog->id,
                "amount" => [
                    "value" => number_format($paylog->amount, 2, '.', ''),
                    "currency_code" => self::CURRENCY
                ],
                "description" => $advert->payDescription
            ]],
            "application_context" => [
                "cancel_url" => Yii::app()->createAbsoluteUrl('site/cancel'),
                "return_url" => Yii::app()->createAbsoluteUrl('site/done')
            ]
        ];

        $accessToken = $this->getAccessToken();

        $ch = curl_init($this->apiUrl . "/v2/checkout/orders");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $accessToken
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            throw new CHttpException(503, 'Error processing payment');
        }

        $responseData = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new CHttpException(503, 'Error decoding JSON response');
        }

        if (isset($responseData['links']) && is_array($responseData['links'])) {
            foreach ($responseData['links'] as $link) {
                if (isset($link['rel']) && $link['rel'] === 'approve') {
                    Yii::app()->session[__CLASS__ . 'orderID'] = $responseData['id'];
                    Yii::app()->controller->redirect($link['href']);
                    return;
                }
            }
        }

        throw new CHttpException(503, 'Unable to process payment');
    }

    private function getAccessToken()
    {
        $ch = curl_init($this->apiUrl . "/v1/oauth2/token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->clientId . ":" . $this->clientSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            throw new CHttpException(503, 'Unable to get access token');
        }

        $data = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE || !isset($data['access_token'])) {
            throw new CHttpException(503, 'Invalid access token response');
        }

        return $data['access_token'];
    }

    public function completePurchase()
    {
        // Yii::log('completePurchase call by orderID: ' . Yii::app()->session[__CLASS__ . 'orderID'], CLogger::LEVEL_INFO);
        
        if (!isset(Yii::app()->session[__CLASS__ . 'orderID'])) {
            throw new CHttpException(503, 'Transaction not found. Please contact support.');
        }

        $orderId = Yii::app()->session[__CLASS__ . 'orderID'];
        $accessToken = $this->getAccessToken();

        $ch = curl_init($this->apiUrl . "/v2/checkout/orders/{$orderId}/capture");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $accessToken
        ]);
        curl_setopt($ch, CURLOPT_POST, true);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            throw new CHttpException(503, 'Error capturing payment');
        }

        $responseData = json_decode($response, true);
        // Yii::log('Payment capture response data: ' . print_r($responseData, true), CLogger::LEVEL_INFO);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new CHttpException(503, 'Error decoding JSON response');
        }

        // Handle specific PayPal errors
        if (isset($responseData['name']) && $responseData['name'] === 'UNPROCESSABLE_ENTITY') {
            if (!empty($responseData['details'][0]['issue']) && $responseData['details'][0]['issue'] === 'ORDER_ALREADY_CAPTURED') {
                Yii::log("Order {$orderId} has already been captured.", CLogger::LEVEL_WARNING);
                throw new CHttpException(503, 'Order has already been captured.');
            }
        }

        // Check if the payment is completed
        if (isset($responseData['status']) && $responseData['status'] === 'COMPLETED') {
            $tran = Yii::app()->db->beginTransaction();

            try {
                $paylogId = isset($responseData['purchase_units'][0]['reference_id']) ? $responseData['purchase_units'][0]['reference_id'] : null;
                if (!$paylogId) {
                    throw new CHttpException(404, 'Payment log reference ID not found in response.');
                }

                if (!$paylogId) {
                    throw new CHttpException(404, 'Payment log reference ID not found in response.');
                }

                $paylog = Paylog::model()->findByPk($paylogId);
                if (!$paylog) {
                    throw new CHttpException(404, 'Payment log not found.');
                }

                if ($paylog->active) {
                    throw new CHttpException(503, 'Payment already processed.');
                }

                $paylog->active = 1;
                if (!$paylog->save()) {
                    Yii::log('Failed to update paylog status for Paylog ID ' . $paylog->id, CLogger::LEVEL_ERROR);
                    throw new CHttpException(500, 'Could not update payment log status.');
                }

                $advert = Advert::model()->findByPk($paylog->advert_id);
                if (!$advert) {
                    throw new CHttpException(404, 'Advert not found.');
                }

                if (!$advert->saveAttributes(['paid' => 1, 'update_time' => new CDbExpression('NOW()')])) {
                    Yii::log('Failed to update payment status for Advert ID ' . $advert->id, CLogger::LEVEL_ERROR);
                    throw new CHttpException(500, 'Could not update advert payment status.');
                }

                $tran->commit();

                if (!YII_DEBUG) {
                    Mail::prepare('payments', $advert->id, $advert->user_id);
                }

                // Yii::log("Payment successfully completed for Order ID: {$orderId}", CLogger::LEVEL_INFO);
            } catch (CException $ex) {
                $tran->rollback();
                Yii::log("Error during transaction: " . $ex->getMessage(), CLogger::LEVEL_ERROR);
                throw $ex;
            }
        } else {
            Yii::log("Payment capture failed. Response: " . print_r($responseData, true), CLogger::LEVEL_ERROR);
            throw new CHttpException(503, 'Payment could not be completed.');
        }
    }

    private function getAmount($package)
    {
        $price = Price::model()->findByPk($package);

        if (!$price) {
            throw new CException('Invalid package selected.');
        }

        return $price->value;
    }
}
