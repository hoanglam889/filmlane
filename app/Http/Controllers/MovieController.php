<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Country;
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
}
