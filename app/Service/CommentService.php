<?php

namespace App\Service;

use Exception;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class CommentService
{
    public function getAll(int $id): Collection
    {
        return Comment::where('post_id', $id)->with('user')->get();
    }
    public function createComment(object $dataComment): bool
    {
        try {
            Comment::create([
                'user_id' => Auth::id(),
                'post_id' => $dataComment->id,
                'content' => $dataComment->content,
            ]);
                
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }
}
