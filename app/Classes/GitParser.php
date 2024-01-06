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

    public static function parseLog($logOutput)
    {
        $commits=[];
        preg_match_all("/[^\n]+(?=\n)/",$logOutput,$commits);
        return $commits[0];
    }
}
