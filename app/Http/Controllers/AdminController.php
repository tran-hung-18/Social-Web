<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Service\AdminService;
use App\Service\PostService;

class AdminController extends Controller
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

    public function viewBlog()
    {
        $this->authorize('viewAdmin', User::class);

        return view('admin.blog', [
            'blogs' => $this->adminService->getAllBlog(),
            'dataTotal' => $this->adminService->getTotalRecord(),
        ]);
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

    public function approvedBlog(Post $blog)
    {
        $this->authorize('viewAdmin', User::class);
        if ($this->adminService->approvedBlog($blog)) {
            return redirect()->back()->with('success', __('admin.msg_update_status_blog_success'));
        }

        return redirect()->back()->with('error', __('admin.msg_approved_blog_fail'));
    }
    
    public function approvedAllBlog()
    {
        $this->authorize('viewAdmin', User::class);
        if ($this->adminService->approvedAllBlog()) {

            return redirect()->back()->with('success', __('admin.msg_approved_blogs_success'));
        }

        return redirect()->back()->with('error', __('admin.msg_approved_blogs_fail'));
    }

    public function deleteBlog(Post $blog)
    {
        $this->authorize('delete', $blog);

        if ($this->postService->deleteBlog($blog)) {
            return redirect()->back()->with('success', __('admin.msg_delete_blog_success'));
        }

        return redirect()->back()->with('error', __('admin.msg_delete_blog_fail'));
    }
}
