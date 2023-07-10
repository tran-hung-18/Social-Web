<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Service\PostService;
use App\Service\CategoryService;
use App\Service\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected PostService $postService;

    protected CategoryService $categoryService;

    protected UserService $userService;

    public function __construct(PostService $postService, CategoryService $categoryService, UserService $userService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }

    public function myBlog(Request $request)
    {
        $dataSearch = [
            'data' => $request->data,
            'categoryId' => $request->id,
        ];
        $myBlog = $this->userService->getAllBlog($dataSearch);

        return view('users.my_blog', [
            'request' => $request,
            'blogs' => $myBlog,
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    public function editChangePassword()
    {
        $this->authorize('update', User::class);

        return view('users.change_password');
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $this->authorize('update', User::class);
        if($this->userService->updatePassword($request)) {

            return redirect()->route('user.profile')->with('success', __('auth.change_password_success'));
        }
        
        return redirect()->back()->with('error', __('auth.incorrect_password'));
    }

    public function editProfile()
    {
        $this->authorize('update', User::class);

        return view('users.profile', [
            'profile' => Auth::user(),
        ]);
    }

    public function updateUser(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', User::class);

        if ($this->userService->updateUser($request, $user)) {
            return redirect()->back()->with('success', __('auth.notify_update_profile_success'));
        }
        return redirect()->back()->with('error', __('auth.notify_update_profile_error'));
    }
}
