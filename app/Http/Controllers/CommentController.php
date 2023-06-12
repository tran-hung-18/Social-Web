<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Service\PostService;
use App\Service\CommentService;

class CommentController extends Controller
{
    protected CommentService $commentService;

    protected PostService $postService;

    public function __construct(CommentService $commentService, PostService $postService)
    {
        $this->commentService = $commentService;
        $this->postService = $postService;
    }

    public function create(CommentRequest $request, Post $blog)
    {
        $this->authorize('create', Comment::class);
        if ($this->commentService->create($request, $blog)) {
            return redirect()->back()->with('success', __('comment.notify_create_success'));
        }

        return redirect()->back()->with('error', __('comment.notify_create_error'));
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        if ($this->commentService->update($request, $comment)) {
            return redirect()->back()->with('success', __('comment.notify_update_success'));
        }

        return redirect()->back()->with('error', __('comment.notify_update_error'));
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        if ($this->commentService->delete($comment)) {
            return redirect()->back()->with('success', __('comment.notify_delete_success'));
        }

        return redirect()->back()->with('error', __('comment.notify_delete_error'));
    }
}
