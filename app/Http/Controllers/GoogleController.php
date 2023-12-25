<?php

namespace App\Http\Controllers;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function callBack(){
        $user = Socialite::driver('google')->stateless()->user();
        $findUser = User::where ('email', $user->email)->first();
        if($findUser){
            Auth::login($findUser);
            return redirect('/products');
        }else{
            return redirect('/');
        }
     }
}
