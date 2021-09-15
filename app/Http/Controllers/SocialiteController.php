<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function fbLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function fbLoginCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        $existUser = User::where('email', $user->email)->first();
        $findUser = User::where('facebook_id', $user->id)->first();

        //資料庫已有會員 Facebook ID 資料時重新導向至主控台
        if($findUser){
            Auth::login($findUser);
            return redirect()->intended('dashboard');
        }
        //如果會員資料庫中沒有 Facebook ID 資料，將檢查資料庫中有無會員 email，如果有僅加入 Facebook ID 資料後導向主控台
        if($existUser != '' && $existUser->email === $user->email){
            $existUser->facebook_id = $user->id;
            $existUser->save();
            Auth::login($existUser);
            return redirect()->intended('dashboard');
        }else{
        //資料庫無會員資料時註冊會員資料，然後導向主控台
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'facebook_id'=> $user->id,
                'password' => encrypt('fromsocialwebsite'),
                ]);
            Auth::login($newUser);
            return redirect()->intended('dashboard');
        }
    }
}
