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
        $countries = Geo::getCountryData();

        $options = CHtml::tag('option', ['value' => ''], 'Select country', true);

        foreach ($countries as $country) {
            if (isset($country['country_id'], $country['country_name'], $country['country'])) {
                $options .= CHtml::tag('option', [
                    'value' => $country['country_id'],
                    'data-country-code' => $country['country'],
                ], CHtml::encode($country['country_name']), true);
            }
        }

        echo $options;
    }

    public function actionRegions()
    {
        $countryIso = Yii::app()->request->getQuery('countryIso');

        if (!$countryIso) {
            Yii::log('Missing countryIso parameter', CLogger::LEVEL_ERROR);
            echo CJSON::encode(['error' => 'Missing countryIso parameter']);
            Yii::app()->end();
        }

        // Yii::log("Received countryIso: {$countryIso}", CLogger::LEVEL_INFO);

        $regions = Geo::getRegionData(null, $countryIso);

        if (empty($regions)) {
            Yii::log("No regions found for countryIso {$countryIso}", CLogger::LEVEL_WARNING);
            echo CJSON::encode(['error' => 'No regions found']);
            return;
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

        // Yii::log("Received regionId: {$regionId}", CLogger::LEVEL_INFO);

        try {
            $cities = Geo::getCityData(null, $regionId);

            if (empty($cities)) {
                Yii::log("No cities found for regionId {$regionId}", CLogger::LEVEL_WARNING);
                echo CJSON::encode(['error' => 'No cities found']);
                Yii::app()->end();
            }

            $formattedCities = [];
            foreach ($cities as $city) {
                $formattedCities[] = [
                    'city_id' => $city['city_id'],
                    'city_name' => $city['city_name'],
                ];
            }

            // Yii::log("Cities fetched successfully: " . json_encode($formattedCities), CLogger::LEVEL_INFO);
            echo CJSON::encode($formattedCities);
        } catch (Exception $e) {
            Yii::log("Error fetching cities for regionId {$regionId}: " . $e->getMessage(), CLogger::LEVEL_ERROR);
            echo CJSON::encode(['error' => 'Failed to fetch cities']);
        }
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

        $command = Yii::app()->db->createCommand("SELECT fips AS code FROM country WHERE LOWER(country) = :name");
        $command->bindParam(":name", strtolower($countryName), PDO::PARAM_STR);

        $countryCode = $command->queryScalar();

        if ($countryCode !== false) {
            echo json_encode(['code' => $countryCode]); // Return FIPS code
        } else {
            Yii::log("Country code not found for {$countryName}", CLogger::LEVEL_WARNING);
            echo json_encode(['code' => '']);
        }
    }

    public function actionGetCountryId()
    {
        $countryName = Yii::app()->request->getQuery('name');
        // Yii::log("Received countryName: {$countryName}", CLogger::LEVEL_INFO);

        if (!$countryName) {
            echo CJSON::encode(['id' => null, 'error' => 'Country name is required']);
            Yii::log('Country name is missing', CLogger::LEVEL_ERROR);
            Yii::app()->end();
        }

        $country = Yii::app()->db->createCommand()
            ->select('iso AS id, fips AS code')
            ->from('country')
            ->where('LOWER(country) = :name', [':name' => strtolower($countryName)]) // Case-insensitive comparison
            ->queryRow();

        if ($country) {
            // Yii::log("Country found: {$country['id']} with FIPS code: {$country['code']}", CLogger::LEVEL_INFO);
            echo CJSON::encode([
                'id' => $country['id'], // ISO code
                'code' => $country['code'], // FIPS code
            ]);
        } else {
            Yii::log("Country not found: {$countryName}", CLogger::LEVEL_WARNING);
            echo CJSON::encode(['id' => null, 'error' => 'Country not found']);
        }
    }

    public function actionGetRegionId()
    {
        $regionId = Yii::app()->request->getQuery('regionId');
        $countryIso = Yii::app()->request->getQuery('countryIso');

        // Yii::log("Received regionId: {$regionId}, countryIso: {$countryIso}", CLogger::LEVEL_INFO);

        if (!$regionId || !$countryIso) {
            Yii::log('Missing regionId or countryIso parameter', CLogger::LEVEL_ERROR);
            echo CJSON::encode(['error' => 'Missing regionId or countryIso parameter']);
            Yii::app()->end();
        }

        try {
            $region = Yii::app()->db->createCommand()
                ->select('admin_code AS id')
                ->from('region')
                ->where('admin_code = :regionId AND country_iso = :countryIso', [
                    ':regionId' => $regionId,
                    ':countryIso' => $countryIso,
                ])
                ->queryRow();

            if ($region) {
                // Yii::log("Region found: {$region['id']}", CLogger::LEVEL_INFO);
                echo CJSON::encode(['id' => $region['id']]);
            } else {
                Yii::log("Region not found for regionId {$regionId} and countryIso {$countryIso}", CLogger::LEVEL_WARNING);
                echo CJSON::encode(['error' => 'Region not found']);
            }
        } catch (Exception $e) {
            Yii::log("Error fetching region data: " . $e->getMessage(), CLogger::LEVEL_ERROR);
            echo CJSON::encode(['error' => 'Internal server error']);
        }
    }

    private function getValueFromPost($name)
    {
        return isset($_POST[$name]) ? $_POST[$name] : null;
    }
}