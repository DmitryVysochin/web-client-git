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
            $arFile=explode(" ",trim($file));
            $prepareFiles[]=["status"=>$arFile[0],"name"=>$arFile[1]];
        }
        return $prepareFiles;
    }

    public function getDiffFromFile($fileName)
    {
        return $this->connect->gitDiffFromFile($fileName);
    }

    public function getAllBranches()
    {
        $branchOutput=$this->connect->gitBranch();
        $branches=[];
        preg_match_all("/[^\n]+(?=\n)/",$branchOutput,$branches);
        $branches=$branches[0];
        $prepareBranches=[];
        foreach ($branches as $branch){
            $current=trim($branch);
            if($current[0]=="*"){
                $prepareBranches["current"]=substr($current,1);
            }
            else{
                $prepareBranches[]=$current;
            }
        }
        return $prepareBranches;
    }

    public function checkoutBranch($branch)
    {
        $this->connect->gitCheckout($branch);
    }
}
