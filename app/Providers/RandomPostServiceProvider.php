<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Post;

class RandomPostServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->getRandomPost();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get a random post.
     */
    private function getRandomPost()
    {
      $random_post = Post::orderByRaw('RAND()')->first();

      view()->share(compact('random_post'));
    }
}
