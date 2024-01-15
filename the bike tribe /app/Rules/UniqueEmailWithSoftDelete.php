<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueEmailWithSoftDelete implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the email exists in the users table, excluding soft-deleted records
        return DB::table('users')
            ->where('email', $value)
            ->whereNull('deleted_at')
            ->doesntExist();
    }

    public function message()
    {
        return 'The email has already been taken.';
    }
}