<?php

namespace App\Http\Requests\Esewa;

use Illuminate\Foundation\Http\FormRequest;

class EsewaPayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'amt'  => 'required|string',
            'pdc' => 'required|string',
            'psc' => 'required|string',
            'txAmt' => 'required|string',
            'tAmt' => 'required|string',
            'pid' => 'required|string',
        ];
    }
}
