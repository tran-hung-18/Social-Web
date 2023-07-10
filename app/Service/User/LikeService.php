<?php

namespace App\Service\User;

use Exception;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LikeService
{
    public function getStatusLike(int $idBlog): array
    {
        $blog = Post::find($idBlog);
        $user = User::find(Auth::id());
        $hasLiked = $user ? $user->likes()->where('post_id', $idBlog)->exists() : false;
        $countLikeBlog = $blog->likes()->count();

        return [
            'total' => $countLikeBlog,
            'status' => $hasLiked,
        ];
    }

    public function interactive(int $idBlog): bool
    {
        try {
            $user = User::find(Auth::id());
            $like = $user->likes()->wherePivot('post_id', $idBlog)->first();
            if ($like && $like->pivot->user_id == $user->id) {
                $user->likes()->detach($idBlog);

                return true;
            } else {
                Gate::authorize('create', Like::class);
                $user->likes()->attach($idBlog);

                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
