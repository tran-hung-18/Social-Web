<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Service\User\PostService;
use App\Service\User\CategoryService;
use App\Service\User\CommentService;
use App\Service\User\LikeService;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    protected PostService $postService;

    protected CategoryService $categoryService;

    protected CommentService $commentService;

    protected LikeService $likeService;

    public function __construct(PostService $postService, CategoryService $categoryService, CommentService $commentService, LikeService $likeService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->commentService = $commentService;
        $this->likeService = $likeService;
    }

    public function allBlogPublic(Request $request)
    {
        $dataSearch = [
            'data' => $request->data,
            'categoryId' => $request->id,
        ];
        $blogs = $this->postService->getAllBlogPublic($dataSearch);

        return view('guest.home', [
            'blogs' => $blogs,
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    public function detail(Post $blog)
    {
        $commentsBlog = $this->commentService->getAll($blog->id);
        $relatedBlogs = $this->postService->relatedBlog($blog->category_id, $blog->id);
        $resultStatus = $this->likeService->getStatusLike($blog->id);

        return view('guest.detail_blog', [
            'blog' => $blog,
            'comments' => $commentsBlog,
            'relatedBlogs' => $relatedBlogs,
            'totalLike' => $resultStatus['total'],
            'statusLike' => $resultStatus['status'],
            'totalComment' => $blog->comments()->count(),
        ]);
    }

    public function create()
    {
        $this->authorize('create', Post::class);

        return view('users.create_blog', ['categories' => $this->categoryService->getAll()]);
    }

    public function store(CreatePostRequest $request)
    {
        $this->authorize('create', Post::class);
        if ($this->postService->createPost($request)) {
            return redirect()->route('user.blog')->with('success', __('blog.notify_create_success'));
        }

        return redirect()->back()->with('error', __('auth.no_permission'));
    }

    public function edit(Post $blog)
    {
        $this->authorize('update', $blog);

        return view('users.update_blog', [
            'blog' => $blog,
            'categories' => $this->categoryService->getAll(),
            'categorySelected' => $blog->category_id,
        ]);
    }

    public function update(UpdatePostRequest $request, Post $blog)
    {
        $this->authorize('update', $blog);
        if ($this->postService->updateBlog($request, $blog)) {
            return redirect()->route('blog.detail', ['blog' => $blog])->with('success', __('blog.notify_update_success'));
        }

        return redirect()->route('blogs.home')->with('error', __('blog.notify_update_error'));
    }

    public function destroy(Post $blog)
    {
        $this->authorize('delete', $blog);
        if ($this->postService->deleteBlog($blog)) {
            return redirect()->route('blogs.home')->with('success', __('blog.notify_delete_success'));
        }

        return redirect()->route('blogs.home')->with('error', __('blog.notify_delete_error'));
    }
}
