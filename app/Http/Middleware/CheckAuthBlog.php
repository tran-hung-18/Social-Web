<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\Response;

class CheckAuthBlog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $idAuth = Post::find($request->route('id'))->user_id; 
        if (Auth::user()->role == User::ROLE_ADMIN || Auth::id() == $idAuth) {
            return $next($request);
        }

        return redirect()->route('blogs-home')->with('error', __('auth.not_access'));
    }
}
