<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;


class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    const STATUS_APPROVED = 1;

    const STATUS_NOT_APPROVED = 0;

    const LIMIT_BLOG_PAGE_HOME = 6;

    const LIMIT_BLOG_PAGE_MY_BLOG = 3;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'image',
        'status',
    ];

    protected $date = [
        'created_at',
        'updated_at'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
