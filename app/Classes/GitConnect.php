<?php

namespace App\Classes;

use Mockery\Exception;

class GitConnect extends SshConnect
{
    public function __construct($ip, $login = "root", $port = 22, $pathToSite = "/")
    {
        parent::__construct($ip, $login, $port, $pathToSite);
    }

    public function gitStatus()
    {
        return $this->gitCommand("git status -s");
    }

    public function gitDiffUnstage()
    {
        return $this->gitCommand("git diff");
    }

    public function gitDiffFromFile($filename)
    {
        return $this->gitCommand("git diff ".$filename);
    }

    public function gitDiffStage()
    {
        return $this->gitCommand("git diff --stage");
    }

    public function gitLog()
    {
        return $this->gitCommand("git log");
    }

    public function gitBranch()
    {
        return $this->gitCommand("git branch");
    }

    public function gitCheckout($data)
    {
        return $this->gitCommand("git checkout ".$data);
    }

    private function gitCommand($command)
    {
        $result=$this->execInPathToSite($command);
        if(empty($result["ERROR"])){
            return $result["RESULT"];
        }
        else{
            throw new \Exception($result["ERROR"]);
        }
    }

}
