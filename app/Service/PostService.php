<?php

namespace App\Service;

use Exception;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function countBlog($idAuth = 0, $idCategory = 0): int
    {
        if ($idAuth != 0) {
            return Post::where('user_id', $idAuth)->count();
        } else if ($idCategory != 0) {
            return Post::where(['category_id' => $idCategory, 'status' => Post::STATUS_APPROVED])->count();
        }
        
        return Post::where('status', Post::STATUS_APPROVED)->count();
    }
    public function getAllBlogPublic($dataSearch = null): object|null
    {
        if ($dataSearch != null) {
            return Post::where('status', Post::STATUS_APPROVED)
            ->where('title', 'like', '%'.$dataSearch.'%')
            ->orWhere('content', 'like', '%'.$dataSearch.'%')
            ->with('user', 'category')
            ->orderBy('id')
            ->get();
        }

        return Post::where('status', Post::STATUS_APPROVED)
        ->with('user', 'category')
        ->orderBy('id')
        ->paginate(Post::LIMIT_BLOG_PAGE_HOME);
    }

    public function getAllBlog(): object|null
    {
        return Post::with('user', 'category')
        ->orderBy('id')
        ->paginate(Post::LIMIT_BLOG_PAGE_HOME);
    }

    public function getAllBlogCategory($categoryId, $id = 0): object|null
    {
        if ($id == 0) {
            return Post::where(['category_id' => $categoryId, 'status' => Post::STATUS_APPROVED])
            ->with('user', 'category')
            ->orderBy('id')
            ->paginate(Post::LIMIT_BLOG_PAGE_HOME);
        }
        return Post::where(['category_id' => $categoryId, 'status' => Post::STATUS_APPROVED])
        ->where('id','<>', $id)
        ->with('user', 'category')
        ->orderBy('id')
        ->limit(4)
        ->get();
    }

    public function getMyBlogCategory($categoryId, $idUser): object|null
    {
        return Post::where(['category_id' => $categoryId, 'user_id'=> $idUser])
        // ->where()
        ->with('user', 'category')
        ->orderBy('id')
        ->paginate(Post::LIMIT_BLOG_PAGE_MY_BLOG);
    }

    public function myBlog($id): object|null
    {
        return Post::where('user_id', $id)
        ->orderBy('id')
        ->paginate(Post::LIMIT_BLOG_PAGE_MY_BLOG);
    }

    public function createPost($data): bool
    {
        try {
            Post::create(['user_id' => Auth::id(),
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'content' => $data['content'],
                'image' => $this->storeAsImg($data),
                'status' => Post::STATUS_NOT_APPROVED
            ]);
                
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }

    public function detailBlog($id): object
    {
        return Post::where('id', $id)
        ->with('user','category')
        ->first();
    }
    
    public function approvedBlog($id): bool
    {
        return Post::where('posts.id', $id)->update(['status' => Post::STATUS_APPROVED]);
    }

    public function unApproved($id): bool
    {
        return Post::where('posts.id', $id)->update(['status' => Post::STATUS_NOT_APPROVED]);
    }

    public function updateBlog($data, $id): bool
    {
        try {
            if (isset($data['image'])) {
                $fileName = $this->storeAsImg($data);
            } else {
                $fileName = Post::find($id)->image;
            }
            Post::find($id)->update(['category_id' => $data['category_id'],
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

    public function deleteBlog($id):bool
    {
        return Post::find($id)->delete();
    }

    public function storeAsImg($data): string
    {
        $image = $data['image'];
        $fileName = time() . 'socialTHH.' . $image->getClientOriginalExtension();
        $image->storeAs('public/images', $fileName);

        return $fileName;
    }
}
