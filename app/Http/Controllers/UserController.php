<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
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
        $movieId = $request->movie_id;
        $episodeId = $request->episode_id;

        // 1. LUÔN LUÔN TĂNG VIEW (Dành cho cả khách và thành viên)
        $movie = Movie::find($movieId);
        if ($movie) {
            $movie->increment('views');
        }

        // 2. LƯU LỊCH SỬ (Chỉ dành cho thành viên đã đăng nhập)
        if (Auth::check()) {
            $user = Auth::user();
            /** @var \App\Models\User $user */
            $user->watchedHistory()->syncWithoutDetaching([
                $movieId => [
                    'episode_id' => $episodeId,
                    'updated_at' => now()
                ]
            ]);

            return response()->json([
                'status' => 'success', 
                'message' => 'Đã tăng view và lưu lịch sử!'
            ]);
        }

        return response()->json([
            'status' => 'success', 
            'message' => 'Đã tăng view (Guest)!'
        ]);
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