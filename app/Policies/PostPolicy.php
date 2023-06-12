<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
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
        return Auth::check() && $user->role === User::ROLE_USER;
    }

    public function update(User $user, Post $post): bool
    {
        return ($user->role === User::ROLE_ADMIN || $user->id === $post->user_id) && $user->status === User::STATUS_ACTIVE;
    }

    public function delete(User $user, Post $post): bool
    {
        return ($user->role === User::ROLE_ADMIN || $user->id === $post->user_id) && $user->status === User::STATUS_ACTIVE;
    }
}
