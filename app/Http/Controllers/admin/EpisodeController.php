<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;

class EpisodeController extends Controller
{
    public function index()
    {
        $movies = Movie::orderBy('id', 'DESC')->get();
        // Gọi ra một cái view mới
        return view('admin.episode_index', compact('movies')); 
    }

    public function show($movie_id)
    {
        $movie = Movie::find($movie_id);
        if(!$movie) return redirect()->back()->with('error', 'Không tìm thấy phim!');
    }

    public function getEpisodes($movie_id)
    {
        $episodes = Episode::where('movie_id', $movie_id)->orderBy('episode_number', 'ASC')->get();
        $count_episodes = count($episodes);
        return view('admin.episode_list', compact('episodes','count_episodes'));
    }
}