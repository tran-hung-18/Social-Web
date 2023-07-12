<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user)
    {
        return Auth::check() && $user->status === User::STATUS_ACTIVE;
    }

    public function isAdmin(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function deleteUser(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }
}
