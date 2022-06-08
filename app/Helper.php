<?php

namespace App;

class Helper
{
    public static function arrayRemoveNull($array)
    {
        if (!is_array($array)) {
            return $array;
        }

        return collect($array)
            ->reject(function ($item) {
                return is_null($item);
            })
            ->toArray();
    }

}
