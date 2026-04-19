<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WatchHistory;

class UserController extends Controller
{
    public function get_film_favories() 
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $movies = $user->favoriteMovies()->get();

        return view('user.favorites', compact('movies'));
    }

    public function saveHistory(Request $request)
    {
        if (Auth::check()) {
            
            /** @var \App\Models\User $user */
            $user = Auth::user();
            
            $movie_id = $request->movie_id;
            
            $user->watchedHistory()->syncWithoutDetaching([
                $movie_id => ['updated_at' => now()]
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Lưu lịch sử xem mượt mà!'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Chưa đăng nhập, không lưu lịch sử'
        ], 401);
    }

    public function removeHistory($movie_id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            WatchHistory::where('user_id', $user->id)
                        ->where('movie_id', $movie_id)
                        ->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Đã xóa khỏi lịch sử!'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Chưa đăng nhập'
        ], 401);
    }
}