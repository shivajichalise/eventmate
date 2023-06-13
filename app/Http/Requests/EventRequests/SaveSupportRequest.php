<?php

namespace App\Http\Requests\EventRequests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSupportRequest extends FormRequest
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
            'email' => 'required|email:rfc,dns',
            'phone' => 'nullable|phone:landline,INTERNATIONAL,NP',
            'mobile' => 'required|phone:mobile,INTERNATIONAL,NP',
            'address' => 'required|string'
        ];
    }
}
