<?php

namespace App\Http\Helpers;

class MiscellaneousMethods
{
    public static function booleanYesNo(bool $value)
    {
        return $value ? "Yes" : "No";
    }
}
