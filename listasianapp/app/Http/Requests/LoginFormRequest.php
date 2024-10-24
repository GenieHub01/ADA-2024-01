<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
            'rememberMe' => 'nullable|boolean',
        ];
    }

    public function attributes()
    {
        return [
            'rememberMe' => 'Remember me next time',
        ];
    }
}

