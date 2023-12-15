<?php

namespace App\Http\Controllers\Connect;

use App\Classes\GitConnect;
use App\Classes\GitManager;
use App\Classes\GitParser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Connect\ConnectSSHModel as Connect;

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
        session()->put("passwordSsh",$connectFields["password"]);

        $connect=Connect::create($connectFields);
        $arConnect=$connect->toArray();

        session()->put("currentConnect",$arConnect["id"]);
        return redirect(route("user.desktop"));
    }

    public static function getGitManagerForCurrentConnect():GitManager
    {
        $idUser=Auth::id();
        $idCurrentConnect=session("currentConnect");
        $connect=Connect::query()->where("id",$idCurrentConnect)->where("idUser",$idUser)->get()->toArray()[0];
        $gitManager=new GitManager($connect["ip"],$connect["login"],$connect["port"],$connect["pathToSite"]);
        return $gitManager;
    }

    public static function login(Request $request)
    {
        $idUser=Auth::id();
        $idCurrentConnect=session("currentConnect");
        $connects=Connect::query()->where("idUser",$idUser)->get()->toArray();
        $currentConnect=[];
        foreach ($connects as $connect){
            if($connect["id"]==$idCurrentConnect){
                $currentConnect=$connect;
            }
        }
        $gitManager=static::getGitManagerForCurrentConnect();
        $filesFromStatus=$gitManager->getFilesFromStatus();
        return view("desktop",compact(["filesFromStatus","currentConnect","connects"]));
    }

    public static function getDiffFromFile(Request $request)
    {
        $data=$request->all();
        $gitManager=static::getGitManagerForCurrentConnect();
        return $gitManager->getDiffFromFile($data["file"]);
    }
}

