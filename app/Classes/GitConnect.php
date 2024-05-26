<?php

namespace App\Classes;

use Mockery\Exception;

class GitConnect extends SshConnect
{
    public string $loginGit;
    public string $passwordGit;

    public function __construct($loginGit, $passwordGit, $ip, $login = "root", $port = 22, $pathToSite = "/")
    {
        parent::__construct($ip, $login, $port, $pathToSite);
        $this->loginGit = $loginGit;
        $this->passwordGit = $passwordGit;
    }

    public function gitStatus()
    {
        return $this->gitCommand("git status -s");
    }

    public function gitDiffFromFile($filename)
    {
        return $this->gitCommand("git diff " . $filename);
    }

    public function gitLog()
    {
        return $this->gitCommand("git log -n 20 --pretty=format:'%s | (%cr)| %an'");
    }

    public function gitBranch()
    {
        return $this->gitCommand("git branch");
    }

    public function gitAdd($file)
    {
        return $this->gitCommand("git add " . $file);
    }

    public function gitCommit($message)
    {
        return $this->gitCommand("git commit -m  '" . $message . "'");
    }

    public function gitRemote()
    {
        return $this->gitCommand("git remote");
    }

    public function gitPull($branch)
    {
        $result = [];
        if ($this->ssh->isConnected()) {
            $this->ssh->write("cd " . $this->pathToSite . PHP_EOL);
            $this->ssh->read($this->login . "@");
            $this->ssh->write("git pull origin " . $branch . " -q" . PHP_EOL);
            $this->logInGit();
            $resultMessage = $this->ssh->read();
            $result = $this->prepareResult($resultMessage);
        } else {
            $resultMessage = "Отсутствует коннект";
            $result["result"] = "ERROR";
            $result["message"] = $resultMessage;
        }

        return $result;
    }

    public function gitPush($branch, $isForce = false)
    {
        $result = [];
        $force = $isForce ? "--force " : "";
        if ($this->ssh->isConnected()) {
            $this->ssh->write("cd " . $this->pathToSite . PHP_EOL);
            $this->ssh->read($this->login . "@");
            $this->ssh->write("git push origin " . $branch . " -q " . $force . PHP_EOL);
            $this->logInGit();
            $resultMessage = $this->ssh->read();
            $result = $this->prepareResult($resultMessage);
        } else {
            $resultMessage = "Отсутствует коннект";
            $result["result"] = "ERROR";
            $result["message"] = $resultMessage;
        }

        return $result;
    }

    public function gitCheckout($data)
    {
        return $this->gitCommand("git checkout " . $data);
    }

    private function logInGit()
    {
        $this->ssh->read("Username for");
        $this->ssh->write($this->loginGit . PHP_EOL);
        $this->ssh->read("Password for");
        $this->ssh->write($this->passwordGit . PHP_EOL);
    }

    private function prepareResult($resultMessage)
    {
        if (stripos($resultMessage, "fatal") !== false || stripos($resultMessage, "error") !== false || stripos($resultMessage, "denied") !== false) {
            $result["result"] = "ERROR";
            $result["message"] = $resultMessage;
        } else {
            $result["result"] = "SUCCESS";
            $result["message"] = $resultMessage;
        }

        return $result;
    }

    public static function isGitInstance()
    {

    }

    //TODO сделать нормальный разбор ошибок
    private function gitCommand($command)
    {
        $result = $this->execInPathToSite($command);
        return $result;
    }

}
