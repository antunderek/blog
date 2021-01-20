<?php

namespace App\Http\Helpers;

class MiscellaneousMethods
{
    public static function booleanYesNo(bool $value)
    {
        return $value ? "Yes" : "No";
    }

    // bashy laracast
    public static function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++)
        {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
