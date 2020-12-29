<?php

namespace App\Http\Helpers;

use App\Article;

class FileHandler
{
    public static function getFileName($imageURL)
    {
        $explodedURL = explode('/', $imageURL);
        return end($explodedURL);
    }

    public static function returnImagePublicPath($imageURL, string $path="")
    {
        if ($imageURL == null)
        {
            return '';
        }
        $fileName = self::getFileName($imageURL);
        return "storage/images/$path$fileName";
    }
}
