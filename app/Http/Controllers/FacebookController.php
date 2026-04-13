<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('provider_id', $user->id)
                            ->where('provider', 'facebook')
                            ->first();

            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('/');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email],[
                    'name' => $user->name,
                    'provider' => 'facebook',
                    'provider_id'=> $user->id,
                    'avatar' => $user->avatar,
                    'password' => encrypt('123456fb')
                ]);
                Auth::login($newUser);
                return redirect()->intended('/');
            }
        } catch (\Exception $e) {
            return redirect('login')->with('error', 'Lỗi FB rồi sếp!');
        }
    }
}