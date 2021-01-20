<?php

namespace App\Http\Helpers;

class FileHandler
{
    public static function getFileName($imageURL)
    {
        $explodedURL = explode('/', $imageURL);
        return end($explodedURL);
    }

    public static function getImage($imageURL, string $path="images/")
    {
        if ($imageURL == null)
        {
            return '';
        }
        $fileName = self::getFileName($imageURL);
        return "storage/$path$fileName";
    }

    public static function imageSize($image)
    {
        return MiscellaneousMethods::bytesToHuman($image->getSize());
    }

    public static function imageResolution($image)
    {
        $imageSizeArr = getimagesize($image);
        return $resolution = "{$imageSizeArr[0]}x{$imageSizeArr[1]}";
    }
}
