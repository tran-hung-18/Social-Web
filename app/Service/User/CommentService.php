<?php

namespace App\Service\User;

use Exception;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class CommentService
{
    public function getAll(int $id): Collection
    {
        return Comment::where('post_id', $id)
            ->with('user')
            ->get();
    }
    public function create(object $dataComment, object $blog): bool
    {
        try {
            Comment::create([
                'user_id' => Auth::id(),
                'post_id' => $blog->id,
                'content' => $dataComment->content,
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function update(object $data, object $comment): bool
    {
        try {
            $comment->update([
                'content' => $data->content,
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function delete(object $comment): bool
    {
        try {
            return $comment->delete();
        } catch (Exception $e) {
            return false;
        }
    }
}
