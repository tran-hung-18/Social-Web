<?php

namespace App\Http\Controllers;

use App\Service\LikeService;

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
