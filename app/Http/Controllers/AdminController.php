<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexAdmin()
    {
        $movies = Movie::orderBy('created_at', 'desc')->paginate(10);
        return view('admin/dashboard', compact('movies'));
    }
}
