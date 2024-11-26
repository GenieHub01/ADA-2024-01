<?php

class GeoController extends Controller
{
    public function filters()
    {
        return [
            [
                'RestfullYii.filters.ERestFilter + REST.GET, REST.PUT, REST.POST, REST.OPTIONS',
            ],
            [
                'postOnly + delete, payTracking',
            ],
        ];
    }

    public function actionCountries()
    {
        $data = Geo::getCountryData();

        echo CHtml::tag('option', ['value' => ''], 'Select country', true);

        if ($data !== null) {
            echo CHtml::tag('option', [
                'value' => $data['country_id']
            ], CHtml::encode($data['country_name']), true);
        }
    }

    public function actionRegions()
    {
        $countryId = Yii::app()->request->getQuery('countryId');

        if (!$countryId) {
            Yii::log('Missing countryId parameter', CLogger::LEVEL_ERROR);
            echo CJSON::encode(['error' => 'Missing countryId parameter']);
            Yii::app()->end();
        }

        Yii::log("Received countryId: {$countryId}", CLogger::LEVEL_INFO);
        
        $username = Yii::app()->params['geonames.username'];
        $url = "http://api.geonames.org/childrenJSON?geonameId={$countryId}&username={$username}";

        Yii::log("Fetching regions from URL: {$url}", CLogger::LEVEL_INFO);

        $response = @file_get_contents($url);
        if ($response === false) {
            Yii::log("Failed to fetch regions for countryId {$countryId}", CLogger::LEVEL_ERROR);
            echo CJSON::encode(['error' => 'Failed to fetch regions']);
            return;
        }

        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            Yii::log("Invalid JSON response: " . $response, CLogger::LEVEL_ERROR);
            echo CJSON::encode(['error' => 'Invalid JSON response from GeoNames API']);
            return;
        }

        $regions = [];
        if (isset($data['geonames']) && is_array($data['geonames'])) {
            foreach ($data['geonames'] as $region) {
                $regions[] = [
                    'id' => $region['geonameId'],
                    'name' => $region['name'],
                ];
            }
        }

        if (empty($regions)) {
            Yii::log("No regions found for countryId {$countryId}", CLogger::LEVEL_WARNING);
        }

        echo CJSON::encode($regions);
    }

    public function actionCities()
    {
        $regionId = Yii::app()->request->getQuery('regionId');

        if (!$regionId) {
            Yii::log('Missing regionId parameter', CLogger::LEVEL_ERROR);
            echo CJSON::encode(['error' => 'Missing regionId parameter']);
            Yii::app()->end();
        }

        Yii::log("Received regionId: {$regionId}", CLogger::LEVEL_INFO);

        $username = Yii::app()->params['geonames.username'];
        $url = "http://api.geonames.org/childrenJSON?geonameId={$regionId}&username={$username}";

        $response = @file_get_contents($url);
        if ($response === false) {
            Yii::log("Failed to fetch cities for regionId {$regionId}", CLogger::LEVEL_ERROR);
            echo CJSON::encode(['error' => 'Failed to fetch cities']);
            return;
        }

        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            Yii::log("Invalid JSON response: " . $response, CLogger::LEVEL_ERROR);
            echo CJSON::encode(['error' => 'Invalid JSON response from GeoNames API']);
            return;
        }

        $cities = [];
        if (isset($data['geonames']) && is_array($data['geonames'])) {
            foreach ($data['geonames'] as $city) {
                $cities[] = [
                    'id' => $city['geonameId'],
                    'name' => $city['name'],
                ];
            }
        }

        if (empty($cities)) {
            Yii::log("No cities found for regionId {$regionId}", CLogger::LEVEL_WARNING);
        }

        echo CJSON::encode($cities);
    }

    /**
     * Action to get the country code based on country name for AJAX requests
     */
    public function actionGetCountryCode()
    {
        $countryName = Yii::app()->request->getQuery('country_name');

        if (!$countryName) {
            echo json_encode(['code' => '']);
            return;
        }

        if (strtolower($countryName) === 'united kingdom') {
            echo json_encode(['code' => 'GB']); // ISO Code for UK
            return;
        }

        $command = Yii::app()->db->createCommand("SELECT code FROM country WHERE name = :name");
        $command->bindParam(":name", $countryName, PDO::PARAM_STR);
        $countryCode = $command->queryScalar();

        if ($countryCode !== false) {
            echo json_encode(['code' => $countryCode]);
            return;
        }

        $username = Yii::app()->params['geonames.username'];
        $url = "http://api.geonames.org/searchJSON?name_equals=" . urlencode($countryName) . "&featureClass=A&maxRows=1&username={$username}";

        $response = @file_get_contents($url);
        if ($response === false) {
            Yii::log("Failed to fetch country code from GeoNames for country_name {$countryName}", CLogger::LEVEL_ERROR);
            echo json_encode(['code' => '']);
            return;
        }

        $data = json_decode($response, true);
        if (isset($data['geonames'][0]['countryCode'])) {
            echo json_encode(['code' => $data['geonames'][0]['countryCode']]);
        } else {
            Yii::log("Country code not found for {$countryName}", CLogger::LEVEL_WARNING);
            echo json_encode(['code' => '']);
        }
    }

    private function getValueFromPost($name)
    {
        return isset($_POST[$name]) ? $_POST[$name] : null;
    }
}
