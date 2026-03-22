<?php
use Illuminate\Support\Facades\Route;

// Controller của trang người dùng
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;

// Controller của trang Admin
use App\Http\Controllers\AdminController;
// THÊM CHỮ "as AdminMovieController" ĐỂ KHÔNG BỊ ĐỤNG HÀNG VỚI THẰNG TRÊN
use App\Http\Controllers\admin\MovieController as AdminMovieController;
use App\Http\Controllers\admin\EpisodeController;


Route::get('/', [MovieController::class, 'index']);
Route::get('/movie-detail/{slug}', [MovieController::class, 'detail']);

// Auth Controller
Route::get('/login', [AuthController::class, 'indexLogin']);



// CÁC ROUTE ADMIN
Route::get('/admin', [AdminController::class, 'indexAdmin']);



Route::get('/admin/movie', [AdminMovieController::class, 'index'])->name('admin.movie.index');
Route::get('/admin/movie/create', [AdminMovieController::class, 'create'])->name('admin.movie.create');

//POST phim lên
Route::post('/admin/movie/store', [AdminMovieController::class, 'store'])->name('admin.movie.store');

//Mở trang sửa movie
Route::get('/admin/movie/{id}/edit', [App\Http\Controllers\admin\MovieController::class, 'edit'])->name('admin.movie.edit');
// Đường dẫn xử lý Lưu Sửa Phim 
Route::put('/admin/movie/{id}', [AdminMovieController::class, 'update'])->name('admin.movie.update');
// Đường dẫn xử lý Xóa Phim 
Route::delete('/admin/movie/{id}', [AdminMovieController::class, 'destroy'])->name('admin.movie.destroy');



//POST category
Route::post('/admin/category/store', [AdminMovieController::class, 'store'])->name('admin.category.store');

//GET espisode
Route::get('/admin/episode', [EpisodeController::class, 'index'])->name('admin.episode_index');
//GET tập phim của 1 phim
Route::get('/admin/episode/movie/{movie_id}', [App\Http\Controllers\admin\EpisodeController::class, 'show'])->name('admin.episode.show');