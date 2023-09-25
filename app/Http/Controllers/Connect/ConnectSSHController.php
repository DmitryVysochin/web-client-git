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
        return view("desktop", compact($isConnect));
    }
}

