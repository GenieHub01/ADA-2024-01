<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PackagePriceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'price_1' => 'required|numeric',
            'price_2' => 'required|numeric',
            'price_3' => 'required|numeric',
            'country_id' => [
                'required',
                'integer',
                Rule::unique('package_price')->where(function ($query) {
                    return $query
                        ->where('region_id', $this->region_id)
                        ->where('sub_region_id', $this->sub_region_id ?? null);
                })->ignore($this->route('packagePrice'))
            ],
            'region_id' => 'required|integer',
            'sub_region_id' => 'nullable|integer',
        ];
    }

    public function attributes()
    {
        return [
            'country_id' => 'Country',
            'region_id' => 'Region',
            'sub_region_id' => 'Sub Region',
        ];
    }
}

