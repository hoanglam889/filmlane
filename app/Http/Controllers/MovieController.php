<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Country;
use App\Models\Favorite;
use App\Models\WatchHistory;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class MovieController extends Controller
{
    public function index()
    {
        $movie_trendings = Movie::where('is_trending', 1)->get();
        $is_upcomings = Movie::where('is_upcoming', 1)->get();
        
        // Lấy danh sách ID phim đã thích nếu user đã đăng nhập
        $likedMovieIds = [];
        if (Auth::check()) {
            $likedMovieIds = Auth::user()->favoriteMovies()->pluck('movies.id')->toArray();
        }

        return view('index', compact('movie_trendings', 'is_upcomings', 'likedMovieIds'));
    }

    public function detail($slug)
    {
        $movie = Movie::where('slug', $slug)->firstOrFail();

        //get episode
        $episodes = Episode::where('movie_id', $movie->id)
                        ->orderBy('episode_number')
                        ->get();
                        
        $comments = Comment::with(['user', 'replies.user' => function($query) {
            $query->orderBy('created_at', 'asc');
        }])
        ->where('movie_id', $movie->id)
        ->whereNull('parent_id')
        ->latest()
        ->get();

        return view('movie-detail', compact('movie', 'episodes', 'comments'));
    }

    public function storeComment(Request $request, $movieId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để bình luận.'
            ], 401);
        }

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'movie_id' => $movieId,
            'content' => $request->content,
            'parent_id' => $request->parent_id
        ]);

        $comment->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Đã gửi bình luận thành công.',
            'comment' => [
                'id' => $comment->id,
                'content' => $comment->content,
                'parent_id' => $comment->parent_id,
                'user_id' => $comment->user_id,
                'user_name' => $comment->user->name,
                'user_initial' => mb_strtoupper(mb_substr($comment->user->name, 0, 1)),
                'color_hash' => substr(md5($comment->user->name), 0, 6),
                'time' => $comment->created_at->diffForHumans()
            ]
        ]);
    }

    public function updateComment(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            return response()->json(['success' => false, 'message' => 'Bạn không có quyền sửa bình luận này.'], 403);
        }

        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $comment->update(['content' => $request->content]);

        return response()->json([
            'success' => true,
            'message' => 'Đã cập nhật bình luận.',
            'content' => $comment->content
        ]);
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            return response()->json(['success' => false, 'message' => 'Bạn không có quyền xóa bình luận này.'], 403);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa bình luận.'
        ]);
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
        
        $likedMovieIds = Auth::check() ? Auth::user()->favoriteMovies()->pluck('movies.id')->toArray() : [];
        
        return View('filter_movie', compact('movies', 'category_name', 'likedMovieIds'));
    }
    public function filter_category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $movies = Movie::where('category_id', $category->id)->orderBy('id', 'DESC')->paginate(12);
        $category_name = $category->title;
        
        $likedMovieIds = Auth::check() ? Auth::user()->favoriteMovies()->pluck('movies.id')->toArray() : [];
        
        return view('filter_movie', compact('movies', 'category_name', 'likedMovieIds'));
    }

    public function filter_movie()
    {
        $movies = Movie::where('is_series', 0)->orderBy('id', 'DESC')->paginate(12);
        $category_name = 'Phim Lẻ';
        
        $likedMovieIds = Auth::check() ? Auth::user()->favoriteMovies()->pluck('movies.id')->toArray() : [];
        
        return view('filter_movie', compact('movies', 'category_name', 'likedMovieIds'));
    }

    public function filter_series()
    {
        $movies = Movie::where('is_series', 1)->orderBy('id', 'DESC')->paginate(12);
        $category_name = 'Phim Bộ';
        
        $likedMovieIds = Auth::check() ? Auth::user()->favoriteMovies()->pluck('movies.id')->toArray() : [];
        
        return view('filter_movie', compact('movies', 'category_name', 'likedMovieIds'));
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
        $user = Auth::user();
        $movies = $user->watchedHistory()->orderBy('watch_histories.updated_at', 'desc')->get();

        return view('user.history', compact('movies'));
    }

}

