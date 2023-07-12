<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ViewBlogNotApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $blog = $request->route('blog');
        if (
            $blog->status === Post::STATUS_APPROVED ||
            Auth::check() && ((Auth::user()->role === User::ROLE_ADMIN) || (Auth::user()->id === $blog->user_id))
        ) {
            return $next($request);
        }

        return redirect()->route('blogs.home')->with('error', __('auth.no_permission'));
    }
}
