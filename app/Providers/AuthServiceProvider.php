<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Http\Models\Article;
use App\Policies\ArticlePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
      Article::class => ArticlePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
