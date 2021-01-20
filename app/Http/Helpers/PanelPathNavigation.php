<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Route;

class PanelPathNavigation
{
    /*
    public static function userPath()
    {
        return [
            'panel' => route(''),
            'users' => '',
        ];
    }
    */

    public static function pathPanelCurrent()
    {
        $path = Route::currentRouteName();
        $pathExploded = explode('.', $path);

        $panelPath = [
            "panel" => route('panel.index'),
        ];

        if ($pathExploded[0] !== 'panel')
        {
            $panelPath += [
                $pathExploded[0] => route("panel.{$pathExploded[0]}"),
            ];
                $tmp = [];
                for ($i = 0; $i < count($pathExploded)-1; $i++) {
                    for ($j = $i; $j >= 0; $j--) {
                        array_unshift($tmp, $pathExploded[$j]);
                    }
                    $panelPath += [
                        $pathExploded[$i] => route(implode('.', $tmp)),
                    ];
                }
                $panelPath += [
                    $pathExploded[$i] => '',
                ];
        }
        else {
            $panelPath += [
                $pathExploded[1] => route("panel.{$pathExploded[1]}"),
            ];
        }

        return $panelPath;
    }
}
