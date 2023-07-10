<?php

namespace App\Service\Admin;

use Exception;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class AdminService
{
    public function getAllBlog(): Collection
    {
        return Post::get();
    }

    public function getAllUser(): Collection
    {
        return User::get();
    }

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

    public function approvedBlog(Post $blog): bool
    {
        try {
            $blog->update([
                'status' => !$blog->status
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function approvedAllBlog(): bool
    {
        try {
            Post::where('status', Post::STATUS_NOT_APPROVED)->update([
                'status' => Post::STATUS_APPROVED
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
