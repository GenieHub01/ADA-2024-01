<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeoFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'country_id' => 'nullable|integer',
            'region_id' => 'nullable|integer',
            'sub_region_id' => 'nullable|integer',
        ];
    }

    public function attributes()
    {
        return [
            'country_id' => 'Country',
            'region_id' => 'Region',
            'sub_region_id' => 'Sub region',
        ];
    }
}

