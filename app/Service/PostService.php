<?php

namespace App\Service;

use Exception;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function getAllBlogPublic(string $data = null, int $idCategory = 0): LengthAwarePaginator
    {
        $query = Post::approved();
        if ($data != null) {
            $query->with('user')->where('title', 'like', '%'.$data.'%');
        }
        elseif ($idCategory != 0) {
            $query->where(['category_id' => $idCategory]);
        } 

        return $query->with('user')
        ->orderBy('id')
        ->paginate(Post::LIMIT_BLOG_PAGE);
    }

    public function relatedBlog(int $categoryId, int $blogId): Collection
    {
        return Post::where([['category_id', $categoryId], ['id', '<>', $blogId]])
        ->approved()
        ->with('user')
        ->limit(Post::LIMIT_BLOG_RELATED)
        ->inRandomOrder()
        ->get();
    }

    public function detailBlog(int $id): object|null
    {
        return Post::where('id', $id)
        ->with('user')
        ->first();
    }

    public function createPost(object $data): bool
    {
        try {
            Post::create(['user_id' => Auth::id(),
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'content' => $data['content'],
                'image' => Storage::disk('public')->put('images', $data->file('image')),
                'status' => Post::STATUS_NOT_APPROVED
            ]);
                
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }

    public function updateBlog(object $data, int $id): bool
    {
        try {
            $post = Post::find($id);
            if (isset($data['image'])) {
                $fileName = Storage::disk('public')->put('images', $data->file('image'));
            } else {
                $fileName = $post->image;
            }
            $post->update(['category_id' => $data['category_id'],
                'title' => $data['title'],
                'content' => $data['content'],
                'image' => $fileName,
            ]);
                        
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }

    public function deleteBlog(int $id):bool
    {    
        return Post::find($id)->delete();
    }
}
