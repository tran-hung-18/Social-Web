<?php

namespace App\Service\Admin;

use App\Models\User;
use App\Models\Post;

class HomeService
{
    public function getTotalRecord(): array
    {
        $totalUser = User::count();
        $totalUserInActive = User::where('status', User::STATUS_INACTIVE)->count();
        $totalBlog = Post::count();
        $totalBlogNotApproved = Post::where('status', Post::STATUS_NOT_APPROVED)->count();

        return [
            'totalUser' => $totalUser,
            'totalUserInActive' => $totalUserInActive,
            'totalBlog' => $totalBlog,
            'totalBlogNotApproved' => $totalBlogNotApproved,
        ];
    }
}
