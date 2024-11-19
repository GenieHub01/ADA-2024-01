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
            throw new CHttpException(404);
        }

        $paylog = new Paylog();
        $paylog->user_id = $advert->user_id;
        $paylog->advert_id = $advert->id;
        $paylog->amount = $this->getAmount($advert->package);
        $paylog->description = $advert->payDescription;
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

        $ch = curl_init("{$this->apiUrl}/v2/checkout/orders");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer $accessToken"
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            throw new CHttpException(503, 'Error processing payment');
        }

        $responseData = json_decode($response, true);

        foreach ($responseData['links'] as $link) {
            if ($link['rel'] === 'approve') {
                Yii::app()->session[__CLASS__ . 'orderID'] = $responseData['id'];
                Yii::app()->controller->redirect($link['href']);
                return;
            }
        }

        throw new CHttpException(503, 'Unable to process payment');
    }

    private function getAccessToken()
    {
        $ch = curl_init("{$this->apiUrl}/v1/oauth2/token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->clientId . ":" . $this->clientSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            throw new CHttpException(503, 'Unable to get access token');
        }

        $data = json_decode($response, true);
        return $data['access_token'];
    }

    public function completePurchase()
    {
        Yii::log('completePurchase dipanggil dengan orderID: ' . Yii::app()->session[__CLASS__ . 'orderID'], CLogger::LEVEL_INFO);
        if (!isset(Yii::app()->session[__CLASS__ . 'orderID'])) {
            throw new CHttpException(503, 'Transaction not found. Please contact support.');
        }

        $orderId = Yii::app()->session[__CLASS__ . 'orderID'];
        $accessToken = $this->getAccessToken();

        $ch = curl_init("{$this->apiUrl}/v2/checkout/orders/{$orderId}/capture");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer $accessToken"
        ]);
        curl_setopt($ch, CURLOPT_POST, true);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            throw new CHttpException(503, 'Error capturing payment');
        }

        $responseData = json_decode($response, true);
        Yii::log('Payment capture response data: ' . print_r($responseData, true), CLogger::LEVEL_INFO);

        if ($responseData['status'] == 'COMPLETED') {
            $tran = Yii::app()->db->beginTransaction();

            try {
                $paylog = Paylog::model()->findByPk($responseData['purchase_units'][0]['reference_id']);
                if (!$paylog) {
                    throw new CHttpException(404, 'Payment log not found');
                }
                if ($paylog->active) {
                    throw new CHttpException(503, 'Payment already processed.');
                }

                $paylog->active = 1;
                if (!$paylog->save()) {
                    Yii::log('Failed to update paylog status for Paylog ID ' . $paylog->id, CLogger::LEVEL_ERROR);
                    throw new CHttpException(500, 'Could not update payment log status');
                }

                $advert = Advert::model()->findByPk($paylog->advert_id);
                if (!$advert) {
                    throw new CHttpException(404, 'Advert not found');
                }

                if (!$advert->saveAttributes(['paid' => 1, 'update_time' => new CDbExpression('NOW()')])) {
                    Yii::log('Failed to update payment status for Advert ID ' . $advert->id, CLogger::LEVEL_ERROR);
                    throw new CHttpException(500, 'Could not update advert payment status');
                }

                $tran->commit();

                if (!YII_DEBUG) {
                    Mail::prepare('payments', $advert->id, $advert->user_id);
                }
            } catch (CException $ex) {
                $tran->rollback();
                throw $ex;
            }
        } else {
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
