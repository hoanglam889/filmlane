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
        return view('admin.episode_list', compact('episodes','count_episodes', 'movie_id'));
    }

    public function create($movie_id)
    {
        $movie = Movie::findOrFail($movie_id);
        return view('admin.create_episode', compact('movie'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'episode_number' => 'required|numeric',
            'video_link' => 'required',
        ]);

        Episode::create([
            'movie_id' => $request->movie_id,
            'episode_number' => $request->episode_number,
            'video_link' => $request->video_link,
            'status' => $request->status ?? 'active',
        ]);

        return redirect()->route('admin.episode.get_episodes', $request->movie_id)->with('success', 'Thêm tập mới thành công!');
    }

    public function edit($id)
    {
        $current_episode = Episode::findOrFail($id);
        $movie = Movie::findOrFail($current_episode->movie_id);
        // Lấy tất cả các tập của phim này để hiển thị danh sách
        $episodes = Episode::where('movie_id', $movie->id)->orderBy('episode_number', 'ASC')->get();
        
        return view('admin.episodes_edit', compact('current_episode', 'movie', 'episodes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'episode_number' => 'required|numeric',
            'video_link' => 'required',
        ]);

        $episode = Episode::findOrFail($id);
        $episode->update([
            'episode_number' => $request->episode_number,
            'video_link' => $request->video_link,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.episode.get_episodes', $episode->movie_id)->with('success', 'Cập nhật tập phim thành công!');
    }

    public function destroy($id)
    {
        $episode = Episode::findOrFail($id);
        $movie_id = $episode->movie_id;
        $episode->delete();

        return redirect()->route('admin.episode.get_episodes', $movie_id)->with('success', 'Xóa tập phim thành công!');
    }
}