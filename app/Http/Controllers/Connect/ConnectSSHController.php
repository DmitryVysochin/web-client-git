<?php

namespace App\Http\Controllers\Connect;

use App\Classes\GitConnect;
use App\Classes\SshConnect;
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
        session()->now("passwordSsh",$connectFields["password"]);
        $connect=new GitConnect($connectFields["ip"],$connectFields["login"],$connectFields["port"],$requestFields["pathToSite"]);
        $connect->gitDiffUnstage();
        file_put_contents($_SERVER["DOCUMENT_ROOT"]."/log/debug.log", print_r([__FILE__.' '.__LINE__, $connect->gitDiffUnstage()], true).PHP_EOL, FILE_APPEND | LOCK_EX);
        return redirect(route("user.desktop"));
    }
}

