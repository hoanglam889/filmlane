<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;

class MovieController extends Controller
{
    public function index()
    {
        $movie_trendings = Movie::where('is_trending', 1)->get();
        $is_upcomings = Movie::where('is_upcoming', 1)->get();
        return view('index', compact('movie_trendings', 'is_upcomings'));
    }

    public function detail($slug)
    {
        $movie = Movie::where('slug', $slug)->first();

        //get episode
        $episodes = Episode::where('movie_id', $movie->id)
                        ->orderBy('episode_number')
                        ->get();
        return view('movie-detail', compact('movie', 'episodes'));
    }
    public function create()
    {
        return view('admin.movies.create'); 
        // (Nếu ông lưu file trực tiếp ở admin/ thì đổi thành 'admin.create' nha)
    }
}
