<?php

namespace App\Http\Controllers\Connect;

use App\Classes\GitConnect;
use App\Classes\GitManager;
use App\Classes\SshConnect;
use App\Classes\GitParser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Connect\ConnectSSHModel as Connect;

class ConnectSSHController
{
    public static function registration(Request $request)
    {
        try {
            if (!Auth::check()) {
                return redirect(route("user.login"));
            }
            $requestFields = $request->validate([
                "ip" => "required|regex:/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/",
                "port" => "regex:/[0-9]{1,5}/",
                "login" => "required",
                "password" => "",
                "loginGit" => "required",
                "passwordGit" => "",
                "nameConnect" => "required",
                "pathToSite" => "required",
            ]);
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/log/debug.log", print_r([
                    __FILE__ . ' ' . __LINE__,
                    $requestFields,
                ], true) . PHP_EOL, FILE_APPEND | LOCK_EX);
            if (!SshConnect::isConnect($requestFields["ip"], $requestFields["port"], $requestFields["login"], $requestFields["password"])) {
                throw new \Exception("нет подключения");
                //                return redirect(route("user.desktop"));
            }
            //TODO сделать проверку на наличие GIT

            $connectFields = array_merge(["idUser" => Auth::id()], $requestFields);
            session()->put("passwordSsh", $connectFields["password"]);

            $connect = Connect::create($connectFields);
            $arConnect = $connect->toArray();

            session()->put("currentConnect", $arConnect["id"]);
        } catch (\Exception $exception) {
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/log/debug.log", print_r([
                    __FILE__ . ' ' . __LINE__,
                    $exception->getMessage(),
                ], true) . PHP_EOL, FILE_APPEND | LOCK_EX);
        }

        return redirect(route("user.desktop"));
    }

    public static function getGitManagerForCurrentConnect(): GitManager
    {
        $idUser = Auth::id();
        $idCurrentConnect = session("currentConnect");
        if (empty($idCurrentConnect)) {
            $connect = Connect::query()->where("idUser", $idUser)->orderBy('id', 'desc')->limit(1)->first()->toArray();
        } else {
            $connect = Connect::query()->where("id", $idCurrentConnect)->where("idUser", $idUser)->limit(1)->first()
                ->toArray()
            ;
        }

        return new GitManager($connect["loginGit"], $connect["passwordGit"], $connect["ip"], $connect["login"], $connect["port"], $connect["pathToSite"]);
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

    public static function deleteConnect(Request $request)
    {
        if (!Auth::check()) {
            return redirect(route("user.login"));
        }

        $idConnect = $request->post("idConnect");
        $result=Connect::destroy($idConnect);
        session()->pull("passwordSsh");
        session()->pull("currentConnect");

        return response()->json(["result"=>$result]);
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
            if (empty($idCurrentConnect)) {
                throw new \Exception("не выбран коннект");
            }
            $currentConnect = [];
            foreach ($connects as $connect) {
                if ($connect["id"] == $idCurrentConnect) {
                    $currentConnect = $connect;
                }
            }
            $password = session("passwordSsh");
            if (!SshConnect::isConnect($currentConnect["ip"], $currentConnect["port"], $currentConnect["login"], $password)) {
                throw new \Exception("Нет подключения к серверу");
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
            $error = $throwable->getMessage();

            return view("desktop", compact([
                "connects",
                "error",
            ]));
        }
    }

    public static function getDiffFromFile(Request $request)
    {
        $data = $request->all();
        $gitManager = static::getGitManagerForCurrentConnect();

        return response()->json($gitManager->getDiffFromFile($data["file"]));
    }

    public static function push(Request $request)
    {
        try {
            $data = $request->all();
            $gitManager = static::getGitManagerForCurrentConnect();
            $repositories = $gitManager->getRepositories();
            $branch = $data["branch"];
            if (isset($repositories["origin"])) {
                if (isset($data["force"])) {
                    $result = $gitManager->forcePush($branch);
                } else {
                    $result = $gitManager->push($branch);
                }
            } else {
                $result = [
                    "result" => "ERROR",
                    "message" => "отсутствует репозиторий origin",
                ];
            }
        } catch (\Exception $exception) {
            $result = [
                "result" => "ERROR",
                "message" => $exception->getMessage(),
            ];
        }

        return response()->json($result);
    }

    public static function pull(Request $request)
    {
        try {
            $data = $request->all();
            $gitManager = static::getGitManagerForCurrentConnect();
            $branch = $data["branch"];
            $repositories = $gitManager->getRepositories();
            if (isset($repositories["origin"])) {
                $result = $gitManager->pull($branch);
            } else {
                $result = [
                    "result" => "ERROR",
                    "message" => "отсутствует репозиторий origin",
                ];
            }
        } catch (\Exception $exception) {
            $result = [
                "result" => "ERROR",
                "message" => $exception->getMessage(),
            ];
        }

        return response()->json($result);
    }

    public static function checkoutBranch(Request $request)
    {
        try {
            $data = $request->all();
            $gitManager = static::getGitManagerForCurrentConnect();
            $gitManager->checkoutBranch($data["branch"]);
            $result = [
                "result" => "SUCCESS",
                "message" => "checkout " . $data["branch"],
            ];
        } catch (\Exception $exception) {
            $result = [
                "result" => "ERROR",
                "message" => $exception->getMessage(),
            ];
        }

        return response()->json($result);
    }

    public static function commit(Request $request)
    {//TODO сделать нормальным ajax смотри в desctop.js
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
    }

}

