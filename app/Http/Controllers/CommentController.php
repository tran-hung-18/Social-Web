<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Service\CommentService;

class CommentController extends Controller
{
    protected CommentService $commentService;
    
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function create(CommentRequest $request)
    {
        $this->authorize('create', Comment::class);
        if ($this->commentService->createComment($request)) {
            return redirect()->back()->with('success', __('blog.notify_create_comment_success'));
        }

        return redirect()->back()->with('error', __('blog.notify_create_comment_error'));
    }
}
