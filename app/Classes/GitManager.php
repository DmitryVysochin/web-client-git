<?php

namespace App\Classes;

use http\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GitManager
{
    public GitConnect $connect;

    public function __construct($loginGit,$passwordGit,$ip, $login = "root", $port = 22, $pathToSite = "/")
    {
        $this->connect = new GitConnect($loginGit,$passwordGit,$ip, $login, $port, $pathToSite);
    }
    //Долго работает из-за подключения к серверу
    public function getFilesFromStatus()
    {
        $status = $this->connect->gitStatus();
        $files = GitParser::parseStatus($status);
        $files = $files[0];
        $prepareFiles = [];
        foreach ($files as $file) {
            $strFile = preg_replace("/\s+/", " ", trim($file));
            $arFile = explode(" ", $strFile);
            $prepareFiles[] = [
                "status" => $arFile[0],
                "name" => $arFile[1],
            ];
        }

        return $prepareFiles;
    }

    public function getDiffFromFile($fileName)
    {
        return $this->connect->gitDiffFromFile($fileName);
    }

    //Долго работает из-за подключения к серверу
    public function getAllBranches()
    {
        $branchOutput = $this->connect->gitBranch();
        $branches = [];
        preg_match_all("/[^\n]+(?=\n)/", $branchOutput, $branches);
        $branches = $branches[0];
        $prepareBranches = [];
        foreach ($branches as $branch) {
            $current = trim($branch);
            if ($current[0] == "*") {
                $prepareBranches["current"] = substr($current, 1);
            } else {
                $prepareBranches[] = $current;
            }
        }

        return $prepareBranches;
    }

    public function checkoutBranch($branch)
    {
        $this->connect->gitCheckout($branch);
    }

    public function getHistory()
    {
        $logOutput = $this->connect->gitLog();
        $commits = GitParser::parseLog($logOutput);
        $prepareCommits = [];
        foreach ($commits as $commit) {
            $arCommit = explode("|", $commit);
            $prepareCommits[] = [
                "message" => $arCommit[0],
                "author" => $arCommit[1],
                "date" => $arCommit[2],
            ];
        }
        return $prepareCommits;
    }

    public function addFiles($files)
    {
        foreach ($files as $file) {
            $this->connect->gitAdd($file);
        }
    }

    public function getRepositories()
    {
        $remoteOutput=$this->connect->gitRemote();
        $repositories=GitParser::parseRepositories($remoteOutput);
        $prepareRepositories=[];
        foreach ($repositories as $repositoryStr){
            $prepareRepositories[$repositoryStr]=1;
        }
        return $prepareRepositories;
    }

    public function commit($message)
    {
        $this->connect->gitCommit($message);
    }

    public function forcePush($branch)
    {
        return $this->connect->gitPush($branch,true);
    }

    public function push($branch)
    {
        return $this->connect->gitPush($branch);
    }

    public function pull($branch)
    {
        return $this->connect->gitPull($branch);
    }
}
