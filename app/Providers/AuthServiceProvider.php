<?php
namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => UserPolicy::class,
        Comment::class => UserPolicy::class,
        Category::class => UserPolicy::class,
        Tag::class => UserPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

  
    }


}

