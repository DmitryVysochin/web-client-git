<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\RegisterController;
use \App\Http\Controllers\Connect\ConnectSSHController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('userlogin');
});

Route::name('connect.')->group(function () {
    Route::post("/connectRegistration", [ConnectSSHController::class, "registration"])->name("registration");
    Route::post("/loginConnect", [ConnectSSHController::class, "loginConnect"])->name("login");
    Route::post("/deleteConnect", [ConnectSSHController::class, "deleteConnect"])->name("delete");
});

Route::name('git.')->group(function () {
    Route::post("/getDiff", [ConnectSSHController::class, "getDiffFromFile"])->name("diff");
    Route::post("/checkoutBranch", [ConnectSSHController::class, "checkoutBranch"])->name("checkoutBranch");
    Route::post("/commit", [ConnectSSHController::class, "commit"])->name("commit");
    Route::post("/pull", [ConnectSSHController::class, "pull"])->name("pull");
    Route::post("/push", [ConnectSSHController::class, "push"])->name("push");
});


Route::name('user.')->group(function () {
    Route::get("/desktop", [ConnectSSHController::class, "login"])->name("desktop");

    Route::get("/login", function () {
        if (Auth::check()) {
            return redirect(route("user.desktop"));
        }
        return view("userlogin");
    })->name("login");

    Route::post("/login", [LoginController::class, "login"]);

    Route::get("/logout", function () {
        Auth::logout();
        return redirect(route("user.login"));
    })->name("logout");

    Route::get("/registration", function () {
        if (Auth::check()) {
            return redirect(route("user.desktop"));
        }
        return view("userregistration");
    })->name("registration");

    Route::post("/registration", [RegisterController::class, "registration"]);
});
