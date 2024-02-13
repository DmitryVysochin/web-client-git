<?php

namespace App\Classes;

class Tools
{
    public static function prepareFileName($fileName)
    {
        $prepareFileName=$fileName;
        if(strlen($fileName)>20) {
            $prepareFileName = substr($fileName, 0, 9) . ".." . substr($fileName, strlen($fileName) - 9,9);
        }
        return $prepareFileName;
    }
}
