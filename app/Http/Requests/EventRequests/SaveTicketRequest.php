<?php

namespace App\Http\Requests\EventRequests;

use Illuminate\Foundation\Http\FormRequest;

class SaveTicketRequest extends FormRequest
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
            'sub_event' => 'required|string',
            'currency' => 'required|string|size:3',
            'price' => 'required|integer',
            'tax' => 'required|integer',
            'limit' => 'required|integer',
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        $this->merge([
            'sub_event_id' =>  $this->input('sub_event')
        ]);

        $this->request->remove('sub_event');
    }
}
