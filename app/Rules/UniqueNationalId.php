<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
class UniqueNationalId implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        $count = DB::table('pharmacies')->where('national_id', $value)->count();
        $count += DB::table('doctors')->where('national_id', $value)->count();
        $count += DB::table('patients')->where('national_id', $value)->count();

        return $count === 0;
    }
public function message()
    {
        return 'The :attribute must be unique.';
    }
}
