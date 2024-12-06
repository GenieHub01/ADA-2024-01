<?php

class AdvertController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + delete, payTracking',
            [
                'RestfullYii.filters.ERestFilter + REST.GET, REST.PUT, REST.POST, REST.OPTIONS'
            ],
        );
    }

    public function actions()
    {
        return [
            'REST.' => 'RestfullYii.actions.ERestActionProvider',
        ];
    }

    /**
     * Specifies the access control rules.
     * @return array access control rules
     */
    public function accessRules()
    {
        return [
            [
                'allow',
                'actions' => ['REST.GET', 'REST.PUT', 'REST.POST', 'REST.OPTIONS', 'display'],
                'users' => ['*'],
            ],
            [
                'allow',
                'actions' => ['create', 'index', 'pay', 'update', 'view', 'payTracking', 'thanks'],
                'roles' => [User::ROLE_USER],
            ],
            [
                'allow',
                'roles' => [User::ROLE_ADMIN],
            ],
            [
                'deny',
                'users' => ['*'],
            ],
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     * @throws CHttpException Access denied
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        if (!Yii::app()->user->checkAccess('updateAdvert', ['advert' => $model])) {
            throw new CHttpException(403, 'Access denied');
        }

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Display frontend advert.
     */
    public function actionDisplay($id)
    {
        $model = Advert::model()->getCached($id);

        if (!$model) {
            $this->redirect(['category/index']);
        }

        if (Yii::app()->request->requestUri != $model->getSeoUrl()) {
            $this->redirect($model->getSeoUrl(), true, 301);
        }

        $this->pageTitle = $model->getPageTitle();

        $this->render('view',array(
            'model'=>$model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Advert;

        if (Yii::app()->user->checkAccess(User::ROLE_ADMIN)) {
            $model->scenario = 'admin';
        }

        //preview advert
        if (Yii::app()->request->isAjaxRequest) {
            $model->attributes = $_POST['Advert'];
            $model->file = CUploadedFile::getInstance($model, 'file');

            if ($model->validate(['file']) && $model->file instanceof CUploadedFile) {
                $model->saveImage();
                $model->previewFile = $model->image;
            }

            $html = '';
            if ($model->previewFile) {
                $html .= CHtml::image($model->previewFile) . '<br>';
            }

            foreach ($model->attributes as $name=>$attribute) {
                if ($model->filterPreviewAttr($name) && !empty($attribute)) {
                    $html .= '<b>'.$model->getAttributeLabel($name).'</b>' . ' ' . nl2br(CHtml::encode($attribute)) . '<br>';
                }
            }

            echo CJSON::encode([
                'preview'=>$model->previewFile,
                'html'=>$html
            ]);
            Yii::app()->end();
        }

        if (isset($_POST['Advert'])) {
            // Yii::log('POST data: ' . print_r($_POST['Advert'], true), CLogger::LEVEL_INFO);
            $model->attributes = $_POST['Advert'];
            $model->file = CUploadedFile::getInstance($model, 'file');
			$model->active = isset($model->active) ? $model->active : 0;

            // Set categoryList
            $model->categorys = isset($_POST['Advert']['categoryList']) && is_array($_POST['Advert']['categoryList'])
                ? $_POST['Advert']['categoryList']
                : [];
            
            // Fetch country, region, and city data using Geo
            $this->populateGeoData($model);

            // Debugging log
            // Yii::log("Final Geo Data - Country ID: {$model->country_id}, Region ID: {$model->region_id}, City ID: {$model->city_id}, City Name: {$model->city_name}", CLogger::LEVEL_INFO);

            if (empty($model->region_id) || empty($model->city_id)) {
                $model->addError('region', 'Please select a valid region.');
                $model->addError('city_name', 'Please select a valid city.');
            }
            
            // Save model
            if ($model->save()) {
                // Yii::log('Save successful: Advert ID ' . $model->id, CLogger::LEVEL_INFO);
            
                // Reload dropdown lists to ensure consistency
                $model->regionList = $model->getRegionList();
                $model->cityList = $model->getCityList();

                if (!YII_DEBUG) {
                    Mail::prepare('create', $model->id, $model->user_id);
                }
            
                $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::log('Save failed: ' . print_r($model->getErrors(), true), CLogger::LEVEL_ERROR);
            }
        }

        // Populate dropdown lists for the form
        $model->countryList = $model->getCountryList();
        $model->regionList = !empty($model->country_id) ? $model->getRegionList() : [];
        $model->cityList = !empty($model->region_id) ? $model->getCityList() : [];

        $this->render('create', ['model' => $model]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     * @throws CHttpException Access denied
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        $active = $model->active;

        if (!Yii::app()->user->checkAccess('updateAdvert', ['advert' => $model])) {
            throw new CHttpException(403, 'Access denied');
        }

        if (Yii::app()->user->checkAccess(User::ROLE_ADMIN)) {
            $model->scenario = 'admin';
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Advert'])) {
            // Yii::log('POST data: ' . print_r($_POST['Advert'], true), CLogger::LEVEL_INFO);
            $model->attributes = $_POST['Advert'];
            $model->file = CUploadedFile::getInstance($model, 'file');
            
            // Set categoryList
            $model->categorys = isset($_POST['Advert']['categoryList']) ? $_POST['Advert']['categoryList'] : [];

            // Fetch geo data
            $this->populateGeoData($model);

            // Log final data
            // Yii::log("Final Geo Data - Country ID: {$model->country_id}, Region ID: {$model->region_id}, Region Name: {$model->region}, City ID: {$model->city_id}", CLogger::LEVEL_INFO);

            if (empty($model->region_id) || empty($model->city_id)) {
                $model->addError('region', 'Please select a valid region.');
                $model->addError('city_name', 'Please select a valid city.');
            }
            
            // Save the model
            if ($model->save()) {
                // Yii::log('Save successful: Advert ID ' . $model->id, CLogger::LEVEL_INFO);

                // Reload dropdown lists to ensure consistency
                $model->regionList = $model->getRegionList();
                $model->cityList = $model->getCityList();

                if (!YII_DEBUG && Yii::app()->user->checkAccess(User::ROLE_ADMIN) && !$active && $model->active) {
                    Mail::prepare('live', $model->id, $model->user_id);
                }

                $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::log("Save failed: " . print_r($model->getErrors(), true), CLogger::LEVEL_ERROR);
            }
        }

        // Populate dropdown values for update form
        $model->countryList = $model->getCountryList();
        $model->regionList = !empty($model->country_id) ? $model->getRegionList() : [];
        $model->cityList = !empty($model->region_id) ? $model->getCityList() : [];

        $this->render('update', ['model' => $model]);
    }

    private function populateGeoData(&$model)
    {
        // Fetch country data
        if (!empty($model->country_name)) {
            $countryData = Geo::getCountryData($model->country_name);
            if ($countryData) {
                $model->country_id = $countryData['country_id'];
                $model->country_name = $countryData['country_name'];
                // Yii::log("Fetched Country ID: {$model->country_id}", CLogger::LEVEL_INFO);
            } else {
                Yii::log("Invalid country_name: {$model->country_name}", CLogger::LEVEL_ERROR);
            }
        }

        // Fetch region data
        if (!empty($model->region_id) && !empty($model->country_id)) {
            $regionData = Geo::getRegionData($model->region_id, $model->country_id);
            if ($regionData && isset($regionData['region_name'])) {
                $model->region = $regionData['region_name'];
                // Yii::log("Fetched Region Name: {$model->region} for Region ID: {$model->region_id}", CLogger::LEVEL_INFO);
            } else {
                Yii::log("Invalid region_id: {$model->region_id} for Country ID: {$model->country_id}", CLogger::LEVEL_WARNING);
            }
        }

        // Fetch city data
        if (!empty($model->city_id)) {
            $cityData = Geo::getCityData($model->city_id, $model->region_id);
            if ($cityData) {
                $model->city_name = $cityData['city_name'];
            } else {
                Yii::log("Invalid city_id: {$model->city_id} for Region ID: {$model->region_id}", CLogger::LEVEL_WARNING);
            }
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /*
     * return user list
     * $paid return paid or not paid
     * $active return active or not active
     * $expire
     */
    public function actionIndex($paid = null, $active = null)
    {
        //$this->layout = 'column1';

        $this->render('index',array(
            'dataProvider'=>Advert::model()->getOwnList($paid, $active),
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Advert('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Advert']))
            $model->attributes=$_GET['Advert'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * @param integer $id the ID of the model to be loaded
     * @return Advert the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Advert::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Advert $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'advert-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function restEvents()
    {

        $this->onRest('model.limit', function() {
            return isset($_GET['limit']) ? $_GET['limit'] : Yii::app()->params['limit'];
        });

        $this->onRest('model.filter', function() {

            $filter = [];

            $defaultFilter = [
                [
                    'property' => 'paid',
                    'value' => 1
                ],
                [
                    'property' => 'active',
                    'value' => 1
                ],
                [
                    'property' => 'expiry_date',
                    'value' => date('Y-m-d'),
                    'operator' => '>='
                ]
            ];

            if (isset($_GET['filter'])) {
                $filter = CJSON::decode($_GET['filter']);
            }

            return CJSON::encode(CMap::mergeArray($filter, $defaultFilter));

        });

        $this->onRest('model.sort', function() {

            $sort = [
                [
                    'property' => 'seo2',
                    'direction' => 'DESC'
                ],
                [
                    'property' => 'seo1',
                    'direction' => 'DESC'
                ],
                [
                    'property' => 'name',
                    'direction' => 'ASC'
                ]
            ];

            return isset($_GET['sort'])? $_GET['sort']: CJSON::encode($sort);

        });

        $this->onRest('model.with.relations', function($model) {
            return ['categorys'];
        });

    }

    public function actionPayTracking()
    {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $body = sprintf('User %s clicked "Submit Payment" button %s', $user->email, Yii::app()->request->getPost('url'));

        Mail::send(Yii::app()->params['mailer']['to'], 'Submit Payment Button clicked', $body);
    }

    /**
     * Display payment success page.
     */
    public function actionThanks()
    {
        $opay = new Opay();
        $opay->init();

        try {
            $opay->completePurchase();
            Yii::app()->user->setFlash('success', 'Thank you for your payment. Your advert is now live.');
        } catch (Exception $e) {
            Yii::log('Payment completion error: ' . $e->getMessage(), CLogger::LEVEL_ERROR);
            Yii::app()->user->setFlash('error', 'Payment failed: ' . $e->getMessage());
        }

        $this->render('thanks');
    }

    public function actionGetSuggestions()
    {
        $type = Yii::app()->request->getQuery('type');
        $query = Yii::app()->request->getQuery('query');
        $apiKey = Yii::app()->params['mapbox.api_key'];

        $url = sprintf(
            'https://api.mapbox.com/geocoding/v5/mapbox.places/%s.json?access_token=%s&limit=5',
            urlencode($query),
            $apiKey
        );

        $response = file_get_contents($url);
        if ($response === false) {
            Yii::log("Failed to fetch suggestions from Mapbox.", CLogger::LEVEL_ERROR);
            echo json_encode([]);
            return;
        }

        $json = CJSON::decode($response);

        $suggestions = [];
        if (isset($json['features']) && is_array($json['features'])) {
            foreach ($json['features'] as $feature) {
                $suggestions[] = [
                    'place_id' => $feature['id'],
                    'place_name' => $feature['place_name'],
                    'center' => $feature['center'],
                    'context' => isset($feature['context']) ? $feature['context'] : []
                ];
            }
        }

        echo json_encode($suggestions);
    }

    /**
     * Payment processing with PayPal using Opay.
     * @param integer $id the ID of the advert to pay for
     */
    public function actionPay($id)
    {
        $opay = new Opay();
        $opay->init();
        
        try {
            $opay->purchase($id);
        } catch (Exception $e) {
            Yii::log('Payment error: ' . $e->getMessage(), CLogger::LEVEL_ERROR);
            throw new CHttpException(500, 'Payment failed: ' . $e->getMessage());
        }
    }

    public function actionGetCountryId($name)
    {
        $countryName = Yii::app()->request->getQuery('name');

        // Yii::log('Fetching country ID for: ' . $countryName, CLogger::LEVEL_INFO);

        if (!$countryName) {
            Yii::log('Country name is missing.', CLogger::LEVEL_ERROR);
            echo CJSON::encode(['id' => null, 'error' => 'Country name is required']);
            Yii::app()->end();
        }

        $country = Yii::app()->db->createCommand()
            ->select('iso AS id')
            ->from('country')
            ->where('country=:name', [':name' => $name])
            ->queryRow();

        if ($country) {
            // Yii::log('Found country ID: ' . $country['id'], CLogger::LEVEL_INFO);
            echo CJSON::encode(['id' => $country['id']]);
        } else {
            Yii::log('Country not found for: ' . $countryName, CLogger::LEVEL_WARNING);
            echo CJSON::encode(['id' => null, 'error' => 'Country not found']);
        }
    }

    public function actionGetRegionId($name, $countryId)
    {
        $region = Yii::app()->db->createCommand()
            ->select('admin_code AS id')
            ->from('region')
            ->where('name=:name AND country_iso=:countryId', [
                ':name' => $name,
                ':countryId' => $countryId,
            ])
            ->queryRow();

        echo CJSON::encode(['id' => isset($region['id']) ? $region['id'] : null]);
    }

    private function getValueFromPost($field, $defaultValue)
    {
        return isset($_POST['Advert'][$field]) ? $_POST['Advert'][$field] : $defaultValue;
    }
}
