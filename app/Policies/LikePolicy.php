<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class LikePolicy
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
}
