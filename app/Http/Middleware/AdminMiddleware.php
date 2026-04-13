<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->role !== 1) {
        // Đá nó về trang chủ với một thông báo cay cú
        return redirect('/')->with('error', 'Cút ra! Chỗ này không dành cho bạn.');
    }
        return $next($request);
    }
}
