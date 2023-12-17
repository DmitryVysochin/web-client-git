<?php
namespace App\Classes;

use Mockery\Exception;

class SshConnect
{
    public string $ip;
    public string $login;
    public int $port;
    public string $pathToSite;
    public $connection;

    public function __construct($ip,$login="root",$port=22,$pathToSite="/")
    {
        $connection = ssh2_connect($ip, $port);
        $password = session("passwordSsh");
        if (!empty($password)) {
            $isConnect = ssh2_auth_password($connection, $login, $password);
            if (!$isConnect) {
                throw new Exception("Failed to connect to the server");
            }
            $this->ip = $ip;
            $this->login = $login;
            $this->port = $port;
            $this->pathToSite = $pathToSite;
            $this->connection = $connection;
        }
        else{
            throw new \Exception("empty password");
        }
    }

    public function execInPathToSite($command)
    {
        $stdout_stream = ssh2_exec($this->connection, "cd ".$this->pathToSite."; ".$command);
        $stdio_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDIO);
        $err_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDERR);

        stream_set_blocking($stdio_stream, true);
        stream_set_blocking($err_stream, true);

        $result_stdio = stream_get_contents($stdio_stream);
        $result_err = stream_get_contents($err_stream);
        if(strlen($result_stdio)==0)
        {
            return "удалено";
        }
        return $result_stdio;
    }
}
