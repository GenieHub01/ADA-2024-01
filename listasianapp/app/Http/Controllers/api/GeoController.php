<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GeoService;
use Illuminate\Http\Request;

class GeoController extends Controller
{
    protected $GeoService;

    public function __construct(GeoService $geoService)
    {
        $this->GeoService = $geoService;
    }

    public function countries()
    {
        $countries = $this->GeoService->getCountries();
        if ($countries->isEmpty()) {
            return response()->json(['message' => 'No countries found'], 404);
        }
        return response()->json($countries);
    }

    public function regions(Request $request)
    {
        $countryId = $request->input('country_id');
        $regions = $this->GeoService->getRegions($countryId);
        return response()->json($regions);
    }

    public function cities(Request $request)
    {
        $countryId = $request->input('country_id');
        $regionId = $request->input('region_id');
        $cities = $this->GeoService->getCities($countryId, $regionId);
        return response()->json($cities);
    }
}

