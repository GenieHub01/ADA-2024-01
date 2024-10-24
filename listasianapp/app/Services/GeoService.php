<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeoService
{
    protected $accessToken;
    protected $cacheTime;

    public function __construct()
    {
        $this->accessToken = config('services.vk.access_token');
        $this->cacheTime = config('services.vk.cache_time', 3600);
    }

    public function getCountries()
    {
        $key = 'countries';
        return Cache::remember($key, $this->cacheTime, function () {
            $url = sprintf('https://api.vk.com/method/database.getCountries?v=5.21&need_all=1&count=1000&lang=en&access_token=%s',
                $this->accessToken);

            Log::info('Sending request to: ' . $url);
            $response = Http::timeout(120)->get($url);
            Log::info('Response status: ' . $response->status());

            if ($response->failed() || !isset($response['response'])) {
                return [];
            }
    
            $json = $response->json();
    
            if (!isset($json['response']['items'])) {
                return [];
            }
    
            return collect($json['response']['items'])->pluck('title', 'id')->toArray();
        });
    }

    public function getRegions($countryId)
    {
        if ($countryId == 0) {
            return [];
        }
    
        $key = 'regions_' . $countryId;
        return Cache::remember($key, $this->cacheTime, function () use ($countryId) {
            $url = sprintf('https://api.vk.com/method/database.getRegions?v=5.21&count=1000&lang=en&country_id=%s&access_token=%s',
                $countryId, $this->accessToken);
    
            $response = Http::timeout(120)->get($url);
    
            if ($response->failed()) {
                Log::error('Failed to fetch regions from VK API', ['url' => $url, 'response' => $response->body()]);
                return [];
            }
    
            $json = $response->json();
    
            if (!isset($json['response']['items'])) {
                Log::error('Unexpected VK API response structure', ['url' => $url, 'response' => $json]);
                return [];
            }
    
            return collect($json['response']['items'])->pluck('title', 'id')->toArray();
        });
    }

    public function getCities($countryId, $regionId)
    {
        if ($countryId == 0) {
            return [];
        }
    
        $key = 'cities_' . $countryId . '_' . $regionId;
        return Cache::remember($key, $this->cacheTime, function () use ($countryId, $regionId) {
            $url = sprintf(
                "https://api.vk.com/method/database.getCities?v=5.21&need_all=0&count=1000&lang=en&country_id=%s&region_id=%s&access_token=%s",
                $countryId, $regionId, $this->accessToken
            );
    
            $response = Http::timeout(120)->get($url);
    
            if ($response->failed() || !isset($response['response'])) {
                return [];
            }
    
            $json = $response->json();
    
            if (!isset($json['response']['items'])) {
                return [];
            }
    
            return collect($json['response']['items'])->pluck('title', 'id')->toArray();
        });
    }
}
