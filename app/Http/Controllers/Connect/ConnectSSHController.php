<?php

namespace App\Http\Controllers\Connect;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Connect\ConnectSSHModel;

class ConnectSSHController
{
    public static function registration(Request $request)
    {
        if (!Auth::check()) {
            return redirect(route("user.login"));
        }
        $requestFields = $request->validate([
            "ip" => "required|regex:/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/",
            "port" => "regex:/[0-9]{1,5}/",
            "login" => "required",
            "password" => "",
            "pathToSite" => "required",
        ]);
        $connectFields = array_merge(["idUser" => Auth::id()], $requestFields);
        $connection = ssh2_connect($connectFields["ip"], intval($connectFields["port"] ?? 22));
        $isConnect = ssh2_auth_password($connection, $connectFields["login"], $connectFields["password"]);
        $stdout_stream = ssh2_exec($connection, "cd ".$requestFields["pathToSite"]);
        $stdout_stream = ssh2_exec($connection, "git status");

        $sio_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDIO);
        $err_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDERR);

        stream_set_blocking($sio_stream, true);
        stream_set_blocking($err_stream, true);

        $result_dio = stream_get_contents($sio_stream);
        $result_err = stream_get_contents($err_stream);
        file_put_contents("/home/bitrix/ext_www/web-client-git.ivsupport.ru/log/__debug.log", print_r([__FILE__.' '.__LINE__, $result_dio], true).PHP_EOL, FILE_APPEND | LOCK_EX);
        file_put_contents("/home/bitrix/ext_www/web-client-git.ivsupport.ru/log/__debug.log", print_r([__FILE__.' '.__LINE__, $result_err], true).PHP_EOL, FILE_APPEND | LOCK_EX);
        return view("desktop", compact(["result_dio","result_err"]));
    }
}

