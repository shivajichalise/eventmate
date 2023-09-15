<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueEmailExceptSelf implements ValidationRule
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the email is unique in the users table, excluding the current user by ID
        $count = User::where('email', $value)
        ->where('id', '!=', $this->userId)
        ->count();

        if($count > 0) {
            $fail('The email has already been taken.');
        }
    }
}
