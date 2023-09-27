<?php

namespace App\Http\Requests\EventRequests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class SaveGeneralRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',

            'venue' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'lat' => 'required|string',
            'lng' => 'required|string',

            'event_start' => 'required|date_format:m/d/Y g:i A',
            'event_end' => 'required|date_format:m/d/Y g:i A',
            'registration_start' => 'required|date_format:m/d/Y g:i A',
            'registration_end' => 'required|date_format:m/d/Y g:i A',

            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        $this->merge([
           'address' =>  $this->input('venue'),

           'event_start' => Carbon::createFromFormat('m/d/Y g:i A', $this->event_start)
            ->format('Y-m-d H:i:s'),
           'event_end' => Carbon::createFromFormat('m/d/Y g:i A', $this->event_end)
            ->format('Y-m-d H:i:s'),

           'registration_start' => Carbon::createFromFormat('m/d/Y g:i A', $this->registration_start)
            ->format('Y-m-d H:i:s'),
           'registration_end' => Carbon::createFromFormat('m/d/Y g:i A', $this->registration_end)
            ->format('Y-m-d H:i:s'),
        ]);

        $this->request->remove('venue');
    }

}
