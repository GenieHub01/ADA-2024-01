<?php

class Geo
{
    public static function getCountryData($countryName = null)
    {
        if ($countryName) {
            $sql = "SELECT iso AS country_id, fips AS country, country AS country_name 
                FROM country 
                WHERE LOWER(country) = :name 
                LIMIT 1";
            $command = Yii::app()->db->createCommand($sql);

            $lowerCaseCountryName = strtolower($countryName);
            $command->bindParam(":name", $lowerCaseCountryName, PDO::PARAM_STR);
            
            $country = $command->queryRow();

            if ($country !== false) {
                return $country;
            }
            return null;
        }

        $sql = "SELECT iso AS country_id, fips AS country, country AS country_name 
            FROM country 
            ORDER BY country_name ASC";
        $command = Yii::app()->db->createCommand($sql);

        $countries = $command->queryAll();
        return $countries;
    }

    public static function getRegionData($regionId = null, $countryIso = null)
    {
        try {
            // Yii::log("Parameters received - Region ID: {$regionId}, Country ISO: {$countryIso}", CLogger::LEVEL_INFO);
            
            if (empty($regionId) && empty($countryIso)) {
                Yii::log("Missing parameters in getRegionData. Either regionId or countryIso must be provided.", CLogger::LEVEL_WARNING);
                return [];
            }
    
            // Yii::log("Fetching region data. Region ID: " . ($regionId ?: "All regions") . ", Country ISO: {$countryIso}", CLogger::LEVEL_INFO);
            
            $sql = "SELECT admin_code AS region_id, name AS region_name FROM region WHERE 1=1";

            if (!empty($regionId)) {
                $sql .= " AND admin_code = :regionId";
            }
    
            if (!empty($countryIso)) {
                $sql .= " AND country_iso = :countryIso";
            }

            $command = Yii::app()->db->createCommand($sql);
    
            if (!empty($regionId)) {
                $command->bindParam(":regionId", $regionId, PDO::PARAM_STR);
            }

            if (!empty($countryIso)) {
                $command->bindParam(":countryIso", $countryIso, PDO::PARAM_STR);
            }

            // Yii::log("Executing SQL Query: {$sql}", CLogger::LEVEL_INFO);
    
            if ($regionId) {
                $result = $command->queryRow();
                // Yii::log("Fetched Region Data (queryRow): " . json_encode($result), CLogger::LEVEL_INFO);
                return $result;
            } else {
                $results = $command->queryAll();
                // Yii::log("Fetched All Regions (queryAll): " . json_encode($results), CLogger::LEVEL_INFO);
                return $results;
            }
        } catch (Exception $e) {
            Yii::log("Error in getRegionData: " . $e->getMessage(), CLogger::LEVEL_ERROR);
            return null;
        }
    }

    public static function getCityData($cityId = null, $regionId = null)
    {
        try {
            // Yii::log("Parameters received - City ID: {$cityId}, Region Admin Code: {$regionId}", CLogger::LEVEL_INFO);

            if (empty($cityId) && empty($regionId)) {
                Yii::log("Missing parameters in getCityData. Either cityId or regionId must be provided.", CLogger::LEVEL_WARNING);
                return [];
            }

            $sql = "SELECT geoname_id AS city_id, name AS city_name FROM city WHERE 1=1";

            if (!empty($cityId)) {
                $sql .= " AND geoname_id = :cityId";
            }

            if (!empty($regionId)) {
                $sql .= " AND admin_code_city = :regionId";
            }

            $sql .= " ORDER BY name ASC";

            $command = Yii::app()->db->createCommand($sql);

            if (!empty($cityId)) {
                $command->bindParam(":cityId", $cityId, PDO::PARAM_INT);
            }

            if (!empty($regionId)) {
                $command->bindParam(":regionId", $regionId, PDO::PARAM_STR);
            }

            // Yii::log("Executing SQL Query: {$sql}", CLogger::LEVEL_INFO);

            if ($cityId) {
                $result = $command->queryRow();
                // Yii::log("Fetched City Data (queryRow): " . json_encode($result), CLogger::LEVEL_INFO);
                return $result;
            } else {
                $results = $command->queryAll();
                // Yii::log("Fetched All Cities (queryAll): " . json_encode($results), CLogger::LEVEL_INFO);
                return $results;
            }
        } catch (Exception $e) {
            Yii::log("Error in getCityData: " . $e->getMessage(), CLogger::LEVEL_ERROR);
            return null;
        }
    }

    public static function getCountryDataById($countryId)
    {
        try {
            $sql = "SELECT iso AS country_id, fips AS country, country AS country_name
                    FROM country
                    WHERE iso = :country_id
                    LIMIT 1";

            $command = Yii::app()->db->createCommand($sql);
            $command->bindParam(":country_id", $countryId, PDO::PARAM_STR);

            return $command->queryRow();
        } catch (Exception $e) {
            Yii::log("Error fetching country data for country_id: {$countryId} - " . $e->getMessage(), CLogger::LEVEL_ERROR);
            return null;
        }
    }
}
