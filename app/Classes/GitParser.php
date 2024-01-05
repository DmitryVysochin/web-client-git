<?php

namespace App\Classes;

class GitParser
{
    public static function parseStatus($statusOutput)
    {
        $files=[];
        preg_match_all("/[^\n]+(?=\n)/",$statusOutput,$files);
        return $files;
    }
}
