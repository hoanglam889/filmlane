<?php
use Illuminate\Support\Facades\Route;

// Controller của trang người dùng
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;


// Controller của trang Admin
use App\Http\Controllers\AdminController;
// THÊM CHỮ "as AdminMovieController" ĐỂ KHÔNG BỊ ĐỤNG HÀNG VỚI THẰNG TRÊN
use App\Http\Controllers\admin\MovieController as AdminMovieController;
use App\Http\Controllers\admin\EpisodeController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\UserController as AdminUserController;

//Khai báo cho API login Google
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;

Route::get('/', [MovieController::class, 'index'])-> name('index');
Route::get('/movie-detail/{slug}', [MovieController::class, 'detail']);
Route::post('/movie-detail/{movie}/comment', [MovieController::class, 'storeComment'])->name('comment.store');
Route::put('/comment/{id}', [MovieController::class, 'updateComment'])->name('comment.update')->middleware('auth');
Route::delete('/comment/{id}', [MovieController::class, 'deleteComment'])->name('comment.destroy')->middleware('auth');

Route::get('/watch-history', [MovieController::class, 'FilmHistory'])->middleware('auth')->name('history');
Route::get('/favorites', [UserController::class, 'get_film_favories'])->middleware('auth')->name('favorites');

Route::post('/user/save-history', [App\Http\Controllers\UserController::class, 'saveHistory'])->name('user.save_history');
Route::delete('/user/remove-history/{movie_id}', [App\Http\Controllers\UserController::class, 'removeHistory'])->name('user.remove_history');

// Auth Controller
//Route::get('/login', [AuthController::class, 'indexLogin']);

// CÁC ROUTE ADMIN
Route::middleware(['auth', 'admin'])->group(function () {

Route::get('/admin', [AdminController::class, 'indexAdmin'])->name('indexAdmin');



Route::get('/admin/movie', [AdminMovieController::class, 'index'])->name('admin.movie.index');
Route::get('/admin/movie/create', [AdminMovieController::class, 'create'])->name('admin.movie.create');
Route::get('/admin/movie/search-ajax', [AdminMovieController::class, 'searchAjax'])->name('admin.search_ajax');

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
Route::get('/admin/episode/{movie_id}', [App\Http\Controllers\admin\EpisodeController::class, 'getEpisodes'])->name('admin.episode.get_episodes');

//MỞ TRANG SỬA TẬP
Route::get('/admin/episode/{id}/edit', [EpisodeController::class, 'edit'])->name('admin.episode.edit');
//Gửi trang sửa tập
Route::put('/admin/episode/update/{id}', [EpisodeController::class, 'update'])->name('admin.episode.update');
//Xóa tập phim
Route::delete('/admin/episode/destroy/{id}', [EpisodeController::class, 'destroy'])->name('admin.episode.destroy');

//Mở trang thêm tập
Route::get('/admin/episode/create/{movie_id}', [EpisodeController::class, 'create'])->name('admin.episode.create');
//Gửi trang thêm tập
Route::post('/episode/store', [EpisodeController::class, 'store'])->name('admin.episode.store');


//Bộ route dùng quản lý danh mục
//Lấy toàn bộ danh sách
Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
//Mở form thêm danh sách
Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
//Gửi form thêm danh sách
Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
//Mở form sửa
Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
//gửi form sửa
Route::put('/admin/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
//Gửi form xóa
Route::delete('/admin/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

// QUẢN LÝ QUỐC GIA
Route::get('/admin/country', [CountryController::class, 'index'])->name('admin.country');
Route::get('/admin/country/create', [CountryController::class, 'create'])->name('admin.country.create');
Route::post('/admin/country/store', [CountryController::class, 'store'])->name('admin.country.store');
Route::get('/admin/country/edit/{id}', [CountryController::class, 'edit'])->name('admin.country.edit');
Route::put('/admin/country/update/{id}', [CountryController::class, 'update'])->name('admin.country.update');
Route::delete('/admin/country/destroy/{id}', [CountryController::class, 'destroy'])->name('admin.country.destroy');

// QUẢN LÝ NGƯỜI DÙNG
Route::get('/admin/user', [AdminUserController::class, 'index'])->name('admin.user');
Route::put('/admin/user/role/{id}', [AdminUserController::class, 'updateRole'])->name('admin.user.update_role');
Route::delete('/admin/user/destroy/{id}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');
});






//Router lọc phim theo quốc gia
Route::get('/quoc-gia/{country}', [MovieController::class, 'filter_country'])->name('filter_country');
//Router lọc phim theo danh mục
Route::get('/the-loai/{category}', [MovieController::class, 'filter_category'])->name('filter_category');
//Router lọc phim lẻ/phim bộ
Route::get('/phim-le', [MovieController::class, 'filter_movie'])->name('filter_movie');
Route::get('/phim-bo', [MovieController::class, 'filter_series'])->name('filter_series');
//Route dùng cho tìm kiếm
Route::get('/tim-kiem-ajax', [App\Http\Controllers\IndexController::class, 'searchAjax']);

//route call API google
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Facebook Login
Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('facebook.login');
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

// API Routes for Like/Save functionality
Route::get('/api/check-auth', [App\Http\Controllers\MovieController::class, 'checkAuth']);
Route::post('/api/toggle-like', [App\Http\Controllers\MovieController::class, 'toggleLike'])->middleware('auth');
Route::post('/movie/rate', [App\Http\Controllers\MovieController::class, 'rate']);

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

//route của php beeze
require __DIR__.'/auth.php';