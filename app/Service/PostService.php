<?php

namespace App\Service;

use Exception;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function getAllBlogPublic(array $dataSearch = []): LengthAwarePaginator
    {
        $query = Post::approved();
        if (isset($dataSearch['data'])) {
            $query->where('title', 'like', '%' . $dataSearch['data'] . '%');
        }
        if (isset($dataSearch['categoryId'])) {
            $query->where(['category_id' => $dataSearch['categoryId']]);
        }

        return $query->with('user')
            ->orderBy('id')
            ->paginate(Post::LIMIT_BLOG_PAGE);
    }

    public function relatedBlog(int $categoryId, int $blogId): Collection
    {
        return Post::approved()
            ->where([['category_id', $categoryId], ['id', '!=', $blogId]])
            ->limit(Post::LIMIT_BLOG_RELATED)
            ->inRandomOrder()
            ->get();
    }

    public function createPost(object $data): bool
    {
        try {
            Post::create([
                'user_id' => Auth::id(),
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'content' => $data['content'],
                'image' => Storage::disk('public')->put('images', $data->file('image')),
                'status' => Post::STATUS_NOT_APPROVED
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function updateBlog(object $data, object $blog): bool
    {
        try {
            if (isset($data['image'])) {
                $fileName = Storage::disk('public')->put('images', $data->file('image'));
            } else {
                $fileName = $blog->image;
            }
            $blog->update([
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'content' => $data['content'],
                'image' => $fileName,
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteBlog(object $blog): bool
    {
        try {
            Comment::where('post_id', $blog->id)->delete();
            $blog->likes()->detach();

            return $blog->delete();
        } catch (Exception $e) {
            return false;
        }
    }
}
