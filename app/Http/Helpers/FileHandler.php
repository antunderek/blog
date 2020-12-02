<?php

namespace App\Http\Helpers;

use App\Article;

class FileHandler
{
    public static function getFileName(Article $article)
    {
        $path = explode('/', $article->image_path);
        return end($path);
    }

    public static function returnImagePublicPath(Article $article)
    {
        $fileName = self::getFileName($article);
        return "storage/images/$fileName";
    }
}
