<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class DynamicRegionCityDropdown extends Component
{
    public $countries;
    public $regions = [];
    public $cities = [];

    public $selectedCountry = null;
    public $selectedRegion = null;
    public $selectedCity = null;

    public function mount()
    {
        // Ambil data countries dari endpoint API
        $this->countries = $this->fetchCountries();
        $this->regions = collect();
        $this->cities = collect();
    }

    public function updatedSelectedCountry($countryId)
    {
        $this->regions = $this->fetchRegions($countryId);
        $this->selectedRegion = null;
        $this->cities = collect(); // Reset cities when country changes
    }

    public function updatedSelectedRegion($regionId)
    {
        $this->cities = $this->fetchCities($this->selectedCountry, $regionId);
        $this->selectedCity = null;
    }

    private function fetchCountries()
    {
        $response = Http::get('/countries'); // API GET Request
        return $response->successful() ? collect($response->json()) : collect();
    }

    private function fetchRegions($countryId)
    {
        $response = Http::post('/regions', ['country_id' => $countryId]); // API POST Request
        return $response->successful() ? collect($response->json()) : collect();
    }

    private function fetchCities($countryId, $regionId)
    {
        $response = Http::post('/cities', ['country_id' => $countryId, 'region_id' => $regionId]); // API POST Request
        return $response->successful() ? collect($response->json()) : collect();
    }

    public function render()
    {
        return view('livewire.dynamic-region-city-dropdown');
    }
}
