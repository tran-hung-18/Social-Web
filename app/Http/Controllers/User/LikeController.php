<?php

namespace App\Http\Controllers\User;

use App\Service\User\LikeService;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    protected LikeService $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function interactive(int $idBlog)
    {
        if ($this->likeService->interactive($idBlog)) {
            $resultStatus = $this->likeService->getStatusLike($idBlog);

            return response()->json([
                'totalLike' => $resultStatus['total'],
                'statusLike' => $resultStatus['status'],
            ]);
        }

        return response()->json([
            'message' => "Error",
        ]);
    }
}
