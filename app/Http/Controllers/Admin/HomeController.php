<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Service\Admin\HomeService;
use App\Service\User\PostService;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected HomeService $homeService;

    protected PostService $postService;

    public function __construct(HomeService $adminService, PostService $postService)
    {
        $this->homeService = $adminService;
        $this->postService = $postService;
    }

    public function viewDashboard()
    {
        $this->authorize('isAdmin', User::class);

        return view('admin.index', [
            'dataTotal' => $this->homeService->getTotalRecord(),
        ]);
    }
}
