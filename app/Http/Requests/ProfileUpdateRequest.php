<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\UniqueEmailExceptSelf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $user = null;
        if($this->route('user')) {
            $user = $this->route('user');
        } else {
            $user = $this->user();
        }

        return [
            'name' => ['string', 'max:255'],
            'email' => ['required', 'email', 'max:255', new UniqueEmailExceptSelf($user->id)],
            // 'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'gender' => ['string', 'max:6', 'in:Male,Female,Others'],
            'is_disabled' => ['boolean'],
        ];
    }
}
