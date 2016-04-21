<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Post;
use App\Tag;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->composeFeatured();
      $this->composeSidebar();
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
     * Feeds home.blade.php with the currently Featured post.
     */
    private function composeFeatured()
    {
      view()->composer('pages.home', function($view) {
        $featured = Post::where('featured', 1)->first();

        $view->with(compact('featured'));
      });
    }

    /**
     * Feeds _sidebar.blade.php with the required variables.
     */
    private function composeSidebar()
    {
      view()->composer('partials._sidebar', function($view) {
        $recent_posts = Post::latest('publish_at')->published()->take(6)->get();

        $archives = Post::latest('publish_at')->published()->get()->groupBy(function($date) {
          return translateMonth($date->created_at->month) . ' ' . $date->created_at->format('Y');
        });

        $tags = Tag::with(['posts' => function($query) {
          $query->published();
        }])->orderByRaw('RAND()')->take(6)->get();

        $view->with(compact('recent_posts', 'archives', 'tags'));
      });
    }

}
