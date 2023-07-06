<?php

namespace App\Providers;

use App\Policies\PostPolicy;
use App\Models\Post;
use App\Policies\CommentPolicy;
use App\Policies\LikePolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
        Like::class => LikePolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::resource('posts', 'PostPolicy');
        Gate::resource('comments', 'CommentPolicy');
        Gate::resource('likes', 'LikePolicy');
        Gate::resource('users', 'UserPolicy');
    }
}
