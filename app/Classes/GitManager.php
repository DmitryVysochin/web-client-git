<?php

namespace App\Classes;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GitManager
{
    public GitConnect $connect;

    public function __construct($ip, $login = "root", $port = 22, $pathToSite = "/")
    {
        $this->connect=new GitConnect($ip,$login,$port,$pathToSite);
    }

    public function getFilesFromStatus()
    {
        $status=$this->connect->gitStatus();
        $files=GitParser::parseStatus($status);
        $files=$files[0];
        $prepareFiles=[];
        foreach ($files as $file)
        {
            $arFile=explode(" ",$file);
            $prepareFiles[]=["status"=>$arFile[1],"name"=>$arFile[2]];
        }
        return $prepareFiles;
    }

    public function getDiffFromFile($fileName)
    {
       $diffOutput=$this->connect->gitDiffForFile($fileName);
       $diff=[];
       preg_match_all("/[^\n]+(?=\n)/",$diffOutput,$diff);
       return response()->json($diff);
    }


}
