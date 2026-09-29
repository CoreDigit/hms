<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniqueEmailAcrossUsers implements ValidationRule
{
    protected $ignoredEmail;

    public function __construct($ignoredEmail = null)
    {
        $this->ignoredEmail = $ignoredEmail;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $usersTables = [
            'admins',
            'doctors',
            'patients',
            'ray_employees',
            'lab_employees',
        ];

        foreach ($usersTables as $table) {
            $query = DB::table($table)->where('email', $value);

            if ($this->ignoredEmail) {
                $query->where('email', '!=', $this->ignoredEmail);
            }

            if ($query->exists()) {
                $fail(__('validation.unique'));
            }
        }
    }
}
