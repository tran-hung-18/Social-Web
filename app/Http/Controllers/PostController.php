<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Service\PostService;
use App\Service\CategoryService;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected PostService $postService;
    
    protected CategoryService $categoryService;
    
    protected $categories;

    public function __construct(PostService $postService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->categories = $this->categoryService->getAll();
    }

    public function allBlog()
    {
        $blogs = $this->postService->getAllBlog();
        
        return $blogs;
    }

    public function allBlogPublic()
    {
        $blogs =$this->postService->getAllBlogPublic();
        $countBlog = $this->postService->countBlog();

        return view('guest.home', ['blogs' => $blogs, 'categories' => $this->categories, 'countBlog' => $countBlog]);
    }
    
    public function allBlogCategory($id)
    {
        $blogs = $this->postService->getAllBlogCategory($id);
        $countBlog = $this->postService->countBlog(0, $id);

        return view('guest.home',['blogs' => $blogs, 'categories' => $this->categories, 'categorySelected' => $id, 'countBlog' => $countBlog]);
    }

    public function searchBlog(Request $request)
    {
        $blogs = $this->postService->getAllBlogPublic($request->data);

        return view('guest.home', ['blogs' => $blogs, 'categories' => $this->categories]);
    }

    public function detail($id)
    {   
        $blog = $this->postService->detailBlog($id);
        $blogs = $this->postService->getAllBlogCategory($blog->category_id, $id);
        
        return view('guest.detail_blog', ['blog' => $blog, 'blogs' => $blogs]);
    }

    public function myBlog()
    {
        $blogs = $this->postService->myBlog(Auth::id());
        $countBlog = $this->postService->countBlog(Auth::id(), 0);

        return view('users.my_blog', ['blogs' => $blogs, 'categories' => $this->categories, 'countBlog' => $countBlog]);
    }

    public function myBlogCategory($id)
    {
        $blogs = $this->postService->getMyBlogCategory($id, Auth::id());
        $countBlog = $this->postService->countBlog(0, $id);

        return view('users.my_blog',['blogs' => $blogs, 'categories' => $this->categories, 'categorySelected' => $id, 'countBlog' => $countBlog]);
    }

    public function create()
    {
        return view('users.create_blog', ['categories'=> $this->categories]);
    }

    public function store(CreatePostRequest $request)
    {
        if ($this->postService->createPost($request->all())) {
            return redirect()->route('blogs-home')->with('success', __('auth.notify_create_blog_success'));
        } 

        return redirect()->back()->with('error', __('auth.notify_create_blog_error'));
    }

    public function approvedBlog(Request $request)
    {
        $result = $this->postService->approvedBlog($request->id);

        return $result;
    }

    public function unApproved(Request $request)
    {
        $result = $this->postService->unApproved($request->id);

        return $result;
    }

    public function edit(string $id)
    {
        $blog = $this->postService->detailBlog($id);
        
        return view('users.update_blog', ['blog'=> $blog, 'categories' => $this->categories, 'categorySelected' => $blog->category_id]);
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $result = $this->postService->updateBlog($request->all(), $id);
        if ($result) {
            return redirect()->route('blog-detail', ['id' => $id])->with('success', __('auth.notify_update_blog_success'));
        }

        return redirect()->route('blogs-home')->with('error', __('auth.notify_update_blog_error'));
    }

    public function destroy($id)
    {
        if ($this->postService->deleteBlog($id)) {
            return redirect()->route('blogs-home')->with('success', __('auth.notify_delete_blog_success'));
        }

        return redirect()->route('blogs-home')->with('success', __('auth.notify_delete_blog_error'));
    }
}
