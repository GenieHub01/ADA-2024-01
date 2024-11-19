<?php

class GeoController extends Controller
{
    public function filters()
    {
        return [
            'postOnly'
        ];
    }

    public function actionCountries()
    {
        $data = Geo::getCountryData('');

        echo CHtml::tag('option', ['value' => ''], 'Select country', true);

        if ($data !== null) {
            echo CHtml::tag('option', ['value' => $data['country_id']], CHtml::encode($data['country_name']), true);
        }
    }

    public function actionRegions()
    {
        $countryId = $this->getValueFromPost('country_id');
        $regionName = $this->getValueFromPost('region_name');

        $data = Geo::getRegionData($regionName, $countryId);

        echo CHtml::tag('option', ['value' => ''], 'Select region', true);

        if ($data !== null) {
            echo CHtml::tag('option', ['value' => $data['region_id']], CHtml::encode($data['region_code']), true);
        }
    }

    public function actionCities()
    {
        $countryId = $this->getValueFromPost('country_id');
        $regionId = $this->getValueFromPost('region_id');
        $cityName = $this->getValueFromPost('city_name');

        $data = Geo::getCityData($cityName, $countryId, $regionId);

        echo CHtml::tag('option', ['value' => ''], 'Select city', true);

        if ($data !== null) {
            echo CHtml::tag('option', ['value' => $data['city_id']], CHtml::encode($data['city_name']), true);
        }
    }

    /**
     * Action to get the country code based on country name for AJAX requests
     */
    public function actionGetCountryCode()
    {
        if (isset($_GET['country_name'])) {
            $countryName = $_GET['country_name'];

            $command = Yii::app()->db->createCommand("SELECT code FROM Country WHERE name = :name");
            $command->bindParam(":name", $countryName, PDO::PARAM_STR);
            $countryCode = $command->queryScalar();

            if ($countryCode !== false) {
                echo json_encode(['code' => $countryCode]);
            } else {
                echo json_encode(['code' => '']);
            }
        } else {
            echo json_encode(['code' => '']);
        }
    }

    private function getValueFromPost($name)
    {
        return isset($_POST[$name]) ? $_POST[$name] : null;
    }
}
