<?php

namespace App\Http\Middleware;

use Closure;

class AccessControlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // わからない＊あってる？
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
        return redirect('/login');
        // ↑ログインしてない状態に戻す場所設定
        }
        return $next($request);
    }

}
