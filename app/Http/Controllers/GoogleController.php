<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    // Hàm này để "đá" sếp sang trang đăng nhập của Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Hàm này để nhận dữ liệu khi Google trả về thành công
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Tìm user xem có ai dùng cái provider_id này chưa
            $finduser = User::where('provider_id', $user->id)
                            ->where('provider', 'google')
                            ->first();

            if($finduser){
                // Thấy rồi thì cho login luôn
                Auth::login($finduser);
                return redirect()->intended('/');
            }else{
                // Chưa có thì tạo mới, lưu luôn cái Avatar xịn của Google vào
                $newUser = User::updateOrCreate(['email' => $user->email],[
                    'name' => $user->name,
                    'provider' => 'google',
                    'provider_id'=> $user->id,
                    'avatar' => $user->avatar, // Cái link ảnh tròn xoe nãy mình bàn nè
                    'password' => encrypt('123456dummy') // Mật khẩu ảo cho có lệ
                ]);

                Auth::login($newUser);
                return redirect()->intended('/');
            }

        } catch (Exception $e) {
            // Lỗi thì đá về login cho sếp làm lại từ đầu
            return redirect('login')->with('error', 'Có lỗi rồi sếp ơi!');
        }
    }
}