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
        session()->put("passwordSsh", $connectFields["password"]);

        $connect = Connect::create($connectFields);
        $arConnect = $connect->toArray();

        session()->put("currentConnect", $arConnect["id"]);

        return redirect(route("user.desktop"));
    }

    public static function getGitManagerForCurrentConnect(): GitManager
    {
        $idUser = Auth::id();
        $idCurrentConnect = session("currentConnect");
        if (empty($idCurrentConnect)) {
            $connect = Connect::query()->where("idUser", $idUser)->orderBy('id', 'desc')->first()->toArray();

        } else {
            $connect = Connect::query()->where("id", $idCurrentConnect)->where("idUser", $idUser)->first()->toArray();
        }
        $gitManager = new GitManager($connect["ip"], $connect["login"], $connect["port"], $connect["pathToSite"]);

        return $gitManager;
    }

    public static function loginConnect(Request $request)
    {
        if (!Auth::check()) {
            return redirect(route("user.login"));
        }
        session()->put("passwordSsh", $request->post("password"));
        session()->put("currentConnect", $request->post("idConnect"));

        return redirect(route("user.desktop"));
    }

    public static function login(Request $request)
    {
        if (!Auth::check()) {
            return redirect(route("user.login"));
        }
        $idUser = Auth::id();
        $connects = Connect::query()->where("idUser", $idUser)->get()->toArray();
        try {
            $idCurrentConnect = session("currentConnect");
            $currentConnect = [];
            foreach ($connects as $connect) {
                if ($connect["id"] == $idCurrentConnect) {
                    $currentConnect = $connect;
                }
            }
            $gitManager = static::getGitManagerForCurrentConnect();
            $filesFromStatus = $gitManager->getFilesFromStatus();
            $allBranches = $gitManager->getAllBranches();
            $history = $gitManager->getHistory();

            return view("desktop", compact([
                "filesFromStatus",
                "currentConnect",
                "connects",
                "allBranches",
                "history",
            ]));
        } catch (\Throwable $throwable) {
            print_r($throwable->getMessage());
            return view("desktop", compact(["connects"]));
        }
    }

    public static function getDiffFromFile(Request $request)
    {
        $data = $request->all();
        $gitManager = static::getGitManagerForCurrentConnect();

        return response()->json($gitManager->getDiffFromFile($data["file"]));
    }

    public static function checkoutBranch(Request $request)
    {
        try {
            $data = $request->all();
            $gitManager = static::getGitManagerForCurrentConnect();
            $gitManager->checkoutBranch($data["branch"]);
        } catch (\Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }

    public static function commit(Request $request)
    {
        $data = $request->all();
        $message = $data["commitName"] . " " . $data["commitDescription"];
        $files = [];
        unset($data["commitName"]);
        unset($data["commitDescription"]);

        foreach ($data as $key => $value) {
            if ($key != "_token") {
                $files[] = $value;
            }
        }
        $gitManager = static::getGitManagerForCurrentConnect();
        $gitManager->addFiles($files);
        $gitManager->commit($message);
        return true;
//        return redirect(route("user.desktop"));
    }

}

