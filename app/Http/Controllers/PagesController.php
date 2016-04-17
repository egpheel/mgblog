<?php

namespace App\Http\Controllers;
use App\Post;
use App\Tag;

class PagesController extends Controller {

  /**
   * Get the index page.
   */
  public function getIndex() {
    $posts = Post::latest('publish_at')->unfeatured()->published()->paginate(5);

    foreach ($posts as $post) {
      $date = $post->publish_at->day . ' ' . translateMonth($post->publish_at->month) . ' ' . $post->publish_at->year;

      $post->date = $date;
    }

    return view('pages.home', compact('posts'));
  }

  /**
   * Get the tags page.
   */
  public function getTags()
  {
    $tags = Tag::all();

    return view('pages.tags', compact('tags'));
  }

  public function getArchives()
  {
    $archives = Post::latest('publish_at')->published()->get()->groupBy(function($date) {
      return translateMonth($date->created_at->month) . ' ' . $date->created_at->format('Y');
    });

    foreach ($archives as $archive=>$arc) {
      foreach ($arc as $posts=>$post) {
        $date = $post->publish_at->day . ' ' . translateMonth($post->publish_at->month);

        $post->date = $date;
      }
    }

    return view('pages.arquivo', compact('archives'));
  }

}
