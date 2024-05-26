<?php

namespace App\Classes;

use phpseclib3\Net\SSH2;

class SshConnect
{
    public string $ip;
    public string $login;
    public int $port;
    public SSH2 $ssh;
    public string $pathToSite;

    protected function __construct($ip, $login = "root", $port = 22, $pathToSite = "/")
    {
        $ssh = new SSH2($ip . ":" . $port);
        $password = session("passwordSsh");
        if (!$ssh->login($login, $password)) {
            throw new \Exception("Failed to connect to the server");
        }
        $this->ssh = $ssh;

        $this->ip = $ip;
        $this->login = $login;
        $this->port = $port;
        $this->pathToSite = $pathToSite;

    }

    public static function isConnect($ip, $port, $login, $password): bool
    {
        $ssh = new SSH2($ip . ":" . $port);
        return $ssh->login($login, $password);
    }

    protected function execInPathToSite($command)
    {
        return $this->ssh->exec("cd " . $this->pathToSite . "; " . $command);
    }
}
