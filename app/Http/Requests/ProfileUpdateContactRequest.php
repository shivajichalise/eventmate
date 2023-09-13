<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'mobile_number' => [
                'required',
                'regex:/^[0-9]{10}$/',
            ],

            'emergency_number' => [
                'required',
                'regex:/^[0-9]{10}$/',
            ],
        ];
    }
}
