<?php

class Geo
{
    /**
     * Fetch country data by name.
     * @param string $countryName
     * @return array|null Returns an array with 'country_id' and 'country_name' or null if not found.
     */
    public static function getCountryData($countryName)
    {
        $sql = "SELECT id AS country_id, name AS country_name FROM country WHERE name = :name";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":name", $countryName, PDO::PARAM_STR);
        $country = $command->queryRow();

        return $country !== false ? $country : null;
    }

    /**
     * Fetch region data by name and country_id.
     * @param string $regionName
     * @param int $countryId
     * @return array|null Returns an array with 'region_id' and 'region_code' or null if not found.
     */
    public static function getRegionData($regionName, $countryId)
    {
        $sql = "SELECT id AS region_id, code AS region_code FROM region WHERE name = :name AND country_id = :country_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":name", $regionName, PDO::PARAM_STR);
        $command->bindParam(":country_id", $countryId, PDO::PARAM_INT);
        $region = $command->queryRow();

        return $region !== false ? $region : null;
    }

    /**
     * .
     * @param int $country_id
     * @return string|null
     */
    public static function getCountryCode($country_id)
    {
        $sql = "SELECT code FROM country WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $country_id, PDO::PARAM_INT);
        $result = $command->queryRow();

        return $result !== false ? $result['code'] : null;
    }

    /**
     * 
     * @param int $region_id
     * @return string|null
     */
    public static function getRegionCode($region_id)
    {
        $sql = "SELECT code FROM region WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $region_id, PDO::PARAM_INT);
        $result = $command->queryRow();

        return $result !== false ? $result['code'] : null;
    }

    /**
     * 
     * @param string $cityName
     * @param int $countryId
     * @param int $regionId
     * @return array|null
     */
    public static function getCityData($cityName, $country_id, $region_id)
    {
        $apiKey = Yii::app()->params['locationiq.api_key'];
        $countryCode = self::getCountryCode($country_id);
        $stateCode = self::getRegionCode($region_id);
        
        if ($countryCode === null || $stateCode === null) {
            return null;
        }

        $url = "https://us1.locationiq.com/v1/autocomplete.php?key={$apiKey}&q=" . urlencode($cityName) . "&countrycodes={$countryCode}&state={$stateCode}&limit=1&format=json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            return null;
        }

        $data = json_decode($response, true);

        if (isset($data[0]['place_id']) && isset($data[0]['display_name'])) {
            return [
                'city_id' => $data[0]['place_id'],
                'city_name' => $data[0]['display_name'],
            ];
        }

        return null;
    }
}
