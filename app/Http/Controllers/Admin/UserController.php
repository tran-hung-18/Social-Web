<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Service\Admin\UserService;
use App\Service\User\PostService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected UserService $userService;

    protected PostService $postService;

    public function __construct(UserService $userService, PostService $postService)
    {
        $this->userService = $userService;
        $this->postService = $postService;
    }

    public function viewUser()
    {
        $this->authorize('isAdmin', User::class);

        return view('admin.user', [
            'users' => $this->userService->getAllUser(),
        ]);
    }

    public function viewProfileUser(User $user)
    {
        $this->authorize('isAdmin', User::class);

        return view('users.profile', [
            'profile' => $user,
        ]);
    }

    public function deleteUser(User $user)
    {
        $this->authorize('deleteUser', User::class);

        if ($this->userService->delete($user)) {
            return redirect()->route('admin.user.index')->with('success', __('admin.msg_delete_user_success'));
        }

        return redirect()->route('admin.user.index')->with('error', __('admin.msg_delete_user_fail'));
    }
}
