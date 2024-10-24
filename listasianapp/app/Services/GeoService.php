<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GeoService
{
    public static function getCountries()
    {
        $key = 'countries';
        
        return Cache::remember($key, config('geo.cache_time'), function () {
            $url = sprintf(
                'https://api.vk.com/method/database.getCountries?v=5.21&need_all=1&count=1000&lang=en&access_token=%s',
                config('services.vk.access_token')
            );
            
            $response = Http::get($url);
            
            if (!$response->successful()) {
                return [];
            }
            
            $json = $response->json();
            
            return collect($json['response']['items'])->pluck('title', 'id')->toArray();
        });
    }

    public static function getCountryName($country_id)
    {
        $countries = self::getCountries();
        return $countries[$country_id] ?? null;
    }

    public static function getRegions($country_id)
    {
        if ($country_id == 0) {
            return [];
        }

        $key = 'regions_' . $country_id;
        
        return Cache::remember($key, config('geo.cache_time'), function () use ($country_id) {
            $url = sprintf(
                'https://api.vk.com/method/database.getRegions?v=5.21&count=1000&lang=en&country_id=%s&access_token=%s',
                $country_id,
                config('services.vk.access_token')
            );

            $response = Http::get($url);

            if (!$response->successful()) {
                return [];
            }

            $json = $response->json();
            
            return collect($json['response']['items'])->pluck('title', 'id')->toArray();
        });
    }

    public static function getRegionName($country_id, $region_id)
    {
        $regions = self::getRegions($country_id);
        return $regions[$region_id] ?? null;
    }

    public static function getCities($country_id, $region_id)
    {
        if ($country_id == 0) {
            return [];
        }

        $key = 'cities_' . $country_id . '_' . $region_id;

        return Cache::remember($key, config('geo.cache_time'), function () use ($country_id, $region_id) {
            $items = [];
            $offset = 0;
            $count = 1000;

            while (true) {
                $url = sprintf(
                    "https://api.vk.com/method/database.getCities?v=5.21&need_all=0&count=1000&lang=en&country_id=%s&region_id=%s&access_token=%s&offset=%d",
                    $country_id,
                    $region_id,
                    config('services.vk.access_token'),
                    $offset
                );

                $response = Http::get($url);

                if (!$response->successful()) {
                    return $items;
                }

                $json = $response->json();
                $items = array_merge($items, collect($json['response']['items'])->pluck('title', 'id')->toArray());

                if ($offset >= $json['response']['count']) {
                    break;
                }

                $offset += $count;
            }

            return $items;
        });
    }

    public static function getCityName($country_id, $region_id, $city_id)
    {
        $cities = self::getCities($country_id, $region_id);
        return $cities[$city_id] ?? null;
    }
}
