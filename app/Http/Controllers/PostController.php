<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Service\PostService;
use App\Service\CategoryService;

class PostController extends Controller
{
    protected PostService $postService;
    
    protected CategoryService $categoryService;
    
    public function __construct(PostService $postService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

    public function allBlogPublic(Request $request)
    {
        $dataSearch = null;
        $categorySelected = 0;
        if (isset($request->all()['title'])) {
            $dataSearch = $request->all()['title'];
            $blogs = $this->postService->getAllBlogPublic($dataSearch);
        } 
        elseif (isset($request->all()['id'])) {
            $categorySelected = $request->all()['id'];
            $blogs = $this->postService->getAllBlogPublic(null, $request->all()['id']);
        }
        else {
            $blogs = $this->postService->getAllBlogPublic();
        }

        return view('guest.home', [
            'blogs' => $blogs,
            'dataSearch' => $dataSearch,
            'categorySelected' => $categorySelected,
            'categories' => $this->categoryService->getAll()
        ]);
    }

    public function detail(int $idBlog)
    {   
        $blog = $this->postService->detailBlog($idBlog);
        $blogs = ($blog != null) ? $this->postService->relatedBlog($blog->category_id, $idBlog) : null;
        
        return view('guest.detail_blog', [
            'blog' => $blog, 
            'blogs' => $blogs
        ]);
    }

    public function create()
    {        
        $this->authorize('create', Post::class);

        return view('users.create_blog', ['categories'=> $this->categoryService->getAll()]);
    }
 
    public function store(CreatePostRequest $request)
    {
        if ($this->postService->createPost($request)) {
            
            return redirect()->route('blogs.home')->with('success', __('blog.notify_create_success'));
        }

        return redirect()->back()->with('error', __('blog.notify_create_error'));
    }

    public function edit(int $id)
    {
        $this->authorize('update', Post::find($id));
        
        $blog = $this->postService->detailBlog($id);
    
        return view('users.update_blog', [
            'blog'=> $blog,
            'categories' => $this->categoryService->getAll(), 
            'categorySelected' => $blog->category_id
        ]);
    }

    public function update(UpdatePostRequest $request, int $id)
    {
        if ($this->postService->updateBlog($request, $id)) {
            return redirect()->route('blog.detail', ['id' => $id])->with('success', __('blog.notify_update_success'));
        }

        return redirect()->route('blogs.home')->with('error', __('blog.notify_update_error'));
    }

    public function destroy(int $id)
    {
        $this->authorize('delete', Post::find($id));

        if ($this->postService->deleteBlog($id)) {
            return redirect()->route('blogs.home')->with('success', __('blog.notify_delete_success'));
        }

        return redirect()->route('blogs.home')->with('success', __('blog.notify_delete_error'));
    }
}
