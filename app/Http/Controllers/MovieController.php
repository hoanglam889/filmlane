<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Country;
use App\Models\Favorite;
use App\Models\WatchHistory;
use Illuminate\Support\Facades\Auth;
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

    public function filter_country($slug){
        $country = Country::where('slug', $slug)-> firstOrFail();
        $movies = Movie::where('country_id', $country->id)->orderBy('id', 'DESC')->paginate(12);
        $category_name = $country->title;
        return View('filter_movie', compact('movies', 'category_name'));
    }
    public function filter_category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $movies = Movie::where('category_id', $category->id)->orderBy('id', 'DESC')->paginate(12);
        $category_name = $category->title;
        return view('filter_movie', compact('movies', 'category_name'));
    }

    /**
     * Check if user is authenticated
     */
    public function checkAuth()
    {
        return response()->json([
            'authenticated' => Auth::check()
        ]);
    }

    /**
     * Toggle like/save for a movie
     */
    public function toggleLike(Request $request)
    {
        // Validate input
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'action' => 'required|in:like,unlike'
        ]);

        $user = Auth::user();
        $movieId = $request->movie_id;
        $action = $request->action;

        try {
            if ($action === 'like') {
                // Check if already liked
                $existing = Favorite::where('user_id', $user->id)
                                ->where('movie_id', $movieId)
                                ->first();

                if (!$existing) {
                    // Create new favorite
                    Favorite::create([
                        'user_id' => $user->id,
                        'movie_id' => $movieId
                    ]);
                }
            } else {
                // Unlike - remove the favorite
                Favorite::where('user_id', $user->id)
                    ->where('movie_id', $movieId)
                    ->delete();
            }

            return response()->json([
                'success' => true,
                'message' => $action === 'like' ? 'Đã lưu phim' : 'Đã bỏ lưu phim'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function FilmHistory()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem lịch sử.');
        }

        $user = Auth::user();
        $movies = $user->watchedHistory()->orderBy('watch_histories.updated_at', 'desc')->get();

        return view('user.history', compact('movies'));
    }

}

