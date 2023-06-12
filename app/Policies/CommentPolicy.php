<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user): bool
    {
        return Auth::check() && $user->role === User::ROLE_USER && $user->status === User::STATUS_ACTIVE;
    }

    public function update(User $user, Comment $comment): bool
    {
        return ($user->role === User::ROLE_ADMIN || $user->id === $comment->user_id) && $user->status === User::STATUS_ACTIVE;
    }

    public function delete(User $user, Comment $comment): bool
    {
        return ($user->role === User::ROLE_ADMIN || $user->id === $comment->user_id) && $user->status === User::STATUS_ACTIVE;
    }
}
