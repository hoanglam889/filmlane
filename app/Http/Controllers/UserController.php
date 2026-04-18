<?php

namespace App\Http\Controllers;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function get_film_favories() {
        $user = Auth::user();
        $movies = $user->favoriteMovies()->get();

        return view('user.favorites', compact('movies'));
    }

    public function get_history(int $id) {
        $movies = Favorite::find($id);
        return view('history', compact('movies'));
    }
}
