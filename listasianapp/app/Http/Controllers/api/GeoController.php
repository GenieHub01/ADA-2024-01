<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeoFormRequest;
use App\Services\GeoService;
use Illuminate\Http\Request;

class GeoController extends Controller
{
    // public function handleGeoForm(GeoFormRequest $request)
    // {
    //     $validated = $request->validated();

    //     return redirect()->back()->with('success', 'Geo form submitted successfully!');
    // }

    // public function countries(Request $request)
    // {
    //     $data = GeoService::getCountries();

    //     return view('geo.countries', compact('data'));
    // }

    // public function regions(Request $request)
    // {
    //     $countryId = $request->input('country_id');
    //     $data = GeoService::getRegions($countryId);

    //     return view('geo.regions', compact('data'));
    // }

    // public function cities(Request $request)
    // {
    //     $countryId = $request->input('country_id');
    //     $regionId = $request->input('region_id');
    //     $data = GeoService::getCities($countryId, $regionId);

    //     return view('geo.cities', compact('data'));
    // }
}
