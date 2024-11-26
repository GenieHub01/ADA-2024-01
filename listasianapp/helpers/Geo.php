<?php

class Geo
{
    public static function getCountryData($countryName = 'United Kingdom')
    {
        if (strtolower($countryName) === 'united kingdom') {
            return [
                'country_id' => 2635167, // GeoName ID for United Kingdom
                'country_name' => 'United Kingdom',
            ];
        }

        $sql = "SELECT id AS country_id, name AS country_name FROM country WHERE name = :name";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":name", $countryName, PDO::PARAM_STR);
        $country = $command->queryRow();

        return $country !== false ? $country : null;
    }

    public static function getRegionData($regionName, $countryId)
    {
        $username = Yii::app()->params['geonames.username'];
        $url = "http://api.geonames.org/childrenJSON?geonameId={$countryId}&username={$username}";

        $response = file_get_contents($url);
        if ($response === false) {
            Yii::log("Failed to fetch regions from GeoNames for countryId {$countryId}", CLogger::LEVEL_ERROR);
            return null;
        }

        $data = json_decode($response, true);
        if (empty($data['geonames'])) {
            Yii::log("GeoNames response is empty for countryId {$countryId}", CLogger::LEVEL_ERROR);
            return null;
        }

        foreach ($data['geonames'] as $region) {
            if (isset($region['name']) && strtolower($region['name']) === strtolower($regionName)) {
                return [
                    'region_id' => $region['geonameId'],
                    'region_code' => $region['adminCode1'] ?? null,
                ];
            }
        }

        Yii::log("Region not found: {$regionName}", CLogger::LEVEL_WARNING);
        return null;
    }

    public static function getRegionCode($region_id)
    {
        $username = Yii::app()->params['geonames.username'];
        $url = "http://api.geonames.org/getJSON?geonameId={$region_id}&username={$username}";

        $response = file_get_contents($url);
        if ($response === false) {
            Yii::log("Failed to fetch region code from GeoNames for region_id {$region_id}", CLogger::LEVEL_ERROR);
            return null;
        }

        $data = json_decode($response, true);

        return $data['adminCode1'] ?? null;
    }

    public static function getCityData($cityName, $countryId, $regionId)
    {
        $username = Yii::app()->params['geonames.username'];
        $url = "http://api.geonames.org/childrenJSON?geonameId={$regionId}&username={$username}";

        $response = file_get_contents($url);
        if ($response === false) {
            Yii::log("Failed to fetch cities from GeoNames for regionId {$regionId}", CLogger::LEVEL_ERROR);
            return null;
        }

        $data = json_decode($response, true);
        if (empty($data['geonames'])) {
            Yii::log("GeoNames response is empty for regionId {$regionId}", CLogger::LEVEL_ERROR);
            return null;
        }

        foreach ($data['geonames'] as $city) {
            if (isset($city['name']) && strtolower($city['name']) === strtolower($cityName)) {
                return [
                    'city_id' => $city['geonameId'],
                    'city_name' => $city['name'],
                ];
            }
        }

        Yii::log("City not found: {$cityName}", CLogger::LEVEL_WARNING);
        return null;
    }
}
