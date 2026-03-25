<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
class IndexController extends Controller
{
    public function searchAjax(Request $request)
    {
        $keyword = $request->get('keyword');
        
        // Tìm phim có chứa chữ khách gõ, chỉ lấy những phim đang active
        // Lấy 5 phim tiêu biểu thôi để cái dropdown không bị dài lê thê
        $movies = Movie::where('status', 'active')
                       ->where('title', 'LIKE', '%' . $keyword . '%')
                       ->orderBy('id', 'DESC')
                       ->limit(5) 
                       ->get();

        // Trả kết quả về dạng JSON
        return response()->json($movies);
    }
}
