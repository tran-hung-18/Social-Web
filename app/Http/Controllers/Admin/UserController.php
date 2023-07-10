<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Service\Admin\AdminService;
use App\Service\User\PostService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected AdminService $adminService;

    protected PostService $postService;

    public function __construct(AdminService $adminService, PostService $postService)
    {
        $this->adminService = $adminService;
        $this->postService = $postService;
    }
    
    public function viewUser()
    {
        $this->authorize('viewAdmin', User::class);

        return view('admin.user', [
            'users' => $this->adminService->getAllUser(),
        ]);
    }

    public function viewProfileUser(User $user)
    {
        $this->authorize('update', User::class);

        return view('users.profile', [
            'profile' => $user,
        ]);
    }
}
