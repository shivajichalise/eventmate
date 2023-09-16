<?php

namespace App\Http\Requests\Result;

use Illuminate\Foundation\Http\FormRequest;

class StoreResultRequest extends FormRequest
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
            'event' => 'required|exists:events,id',
            'sub_event' => 'required|exists:sub_events,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'file' => [
                'nullable',
                'file',
                'mimes:pdf,docx,xlsx,xls', // Allow PDF, DOCX, Excel files
                // Rule::dimensions()->maxWidth(1000)->maxHeight(1000), // Optional: Set maximum dimensions
            ],
        ];
    }
    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        $this->merge([
           'sub_event_id' =>  $this->input('sub_event'),
        ]);

        $this->request->remove('sub_event');
    }
}
