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

    private function composeSidebar()
    {
      view()->composer('partials._sidebar', function($view) {
        $recent_posts = Post::orderBy('created_at', 'desc')->take(6)->get();

        $archives = Post::latest()->get()->groupBy(function($date) {
          return $this->translateMonth($date->created_at->month) . ' ' . $date->created_at->format('Y');
        });

        $tags = Tag::orderByRaw('RAND()')->take(10)->get();

        $view->with(compact('recent_posts', 'archives', 'tags'));
      });
    }

    private function translateMonth($date) {
      switch ($date) {
        case 1:
          $month = 'Janeiro';
          break;
        case 2:
          $month = 'Fevereiro';
          break;
        case 3:
          $month = 'Março';
          break;
        case 4:
          $month = 'Abril';
          break;
        case 5:
          $month = 'Maio';
          break;
        case 6:
          $month = 'Junho';
          break;
        case 7:
          $month = 'Julho';
          break;
        case 8:
          $month = 'Agosto';
          break;
        case 9:
          $month = 'Setembro';
          break;
        case 10:
          $month = 'Outubro';
          break;
        case 11:
          $month = 'Novembro';
          break;
        case 12:
          $month = 'Dezembro';
          break;

        default:
          break;
      }

      return $month;
    }

}
