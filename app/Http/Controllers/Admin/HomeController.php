<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Service\Admin\AdminService;
use App\Service\User\PostService;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected AdminService $adminService;

    protected PostService $postService;

    public function __construct(AdminService $adminService, PostService $postService)
    {
        $this->adminService = $adminService;
        $this->postService = $postService;
    }
    
    public function viewDashboard()
    {
        $this->authorize('viewAdmin', User::class);

        return view('admin.index', [
            'dataTotal' => $this->adminService->getTotalRecord(),
        ]);
    }
}
