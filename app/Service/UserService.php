<?php

namespace App\Service;

use Exception;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    public function getAllBlog(array $dataSearch = []): LengthAwarePaginator
    {
        $query = Post::where('user_id', Auth::id());
        if (isset($dataSearch['data'])) {
            $query->where('title', 'like', '%' . $dataSearch['data'] . '%');
        }
        if (isset($dataSearch['categoryId'])) {
            $query->where(['category_id' => $dataSearch['categoryId']]);
        }

        return $query->with('user')
            ->orderBy('id')
            ->paginate(Post::LIMIT_BLOG_PAGE);    
    }

    public function updatePassword(object $data): bool
    {
        try {
            $user = User::find(Auth::id());
            if (Hash::check($data->password_current, $user->password)) {
                $user->update([
                    'password' => Hash::make($data->password)
                ]);
                
                return true;
            }

            return false;
        } catch(Exception $e) {
            return false;
        }
    }

    public function updateUser(object $data, object $user): bool
    {
        try {
            if (isset($data['avatar'])) {
                $fileName = Storage::disk('public')->put('images', $data->file('avatar'));
            } else {
                $fileName = $user->avatar;
            }
            $user->update([
                'user_name' => $data['user_name'],
                'avatar' => $fileName,
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
