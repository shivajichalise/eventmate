<?php

namespace App\Http\Requests\EventRequests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class SaveSubEventRequest extends FormRequest
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
            'event_start' => 'required|date_format:m/d/Y g:i A',
            'event_end' => 'required|date_format:m/d/Y g:i A',
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        $this->merge([
           'event_start' => Carbon::createFromFormat('m/d/Y g:i A', $this->event_start)
            ->format('Y-m-d H:i:s'),
           'event_end' => Carbon::createFromFormat('m/d/Y g:i A', $this->event_end)
            ->format('Y-m-d H:i:s'),
        ]);
    }
}
