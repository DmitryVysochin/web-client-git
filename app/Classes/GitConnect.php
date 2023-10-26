<?php

namespace App\Classes;

class GitConnect extends SshConnect
{
    public function __construct($ip, $login = "root", $port = 22, $pathToSite = "/")
    {
        parent::__construct($ip, $login, $port, $pathToSite);
    }

    public function gitStatus()
    {
        return $this->execInPathToSite("git status");
    }

    public function gitDiffUnstage()
    {
        return $this->execInPathToSite("git diff");
    }

    public function gitDiffStage()
    {
        return $this->execInPathToSite("git diff --stage");
    }

    public function gitLog()
    {
        return $this->execInPathToSite("git log");
    }

}
