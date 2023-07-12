<?php

namespace App\Service\Admin;

use Exception;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    public function getAllUser(): LengthAwarePaginator
    {
        return User::paginate(User::LIMIT_USER_PAGE);
    }

    public function delete(object $user): bool
    {
        try {
            $user->likes()->detach();
            Comment::where('user_id', $user->id)->delete();
            Post::where('user_id', $user->id)->delete();

            return $user->delete();
        } catch (Exception $e) {
            return false;
        }
    }
}
