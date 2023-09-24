<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function registration(Request $request){
        if(Auth::check()){
            return redirect(route("user.desktop"));
        }
        $validateFields = $request->validate([
            "email"=>"required|email",
            "password"=>"required|min:8",
        ]);
        if(User::where("email",$validateFields["email"])->exists()){
            return redirect(route("user.registration"))->withErrors([
                "email"=>"Пользователь с таким email уже зарегестрирован"
            ]);
        }
        $user = User::create($validateFields);
        if ($user){
            Auth::login($user);
            return redirect(route("user.desktop"));
        }
        return redirect(route("user.registration"))->withErrors([
            "registrationError"=>"Произошла ошибка при регистрации пользователя"
        ]);
    }
}
