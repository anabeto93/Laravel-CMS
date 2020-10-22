<?php

namespace App\Providers;

use App\Repositories\Category\CategoryContract;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Gallery\GalleryContract;
use App\Repositories\Gallery\GalleryRepository;
use App\Repositories\Post\PostContract;
use App\Repositories\Post\PostRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryContract::class, CategoryRepository::class);
        $this->app->bind(PostContract::class, PostRepository::class);
        $this->app->bind(GalleryContract::class, GalleryRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
