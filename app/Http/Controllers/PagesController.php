<?php

namespace App\Http\Controllers;
use App\Post;

class PagesController extends Controller {

  public function getIndex() {
    $posts = Post::latest('publish_at')->unfeatured()->published()->paginate(5);

    foreach ($posts as $post) {
      $date = $post->publish_at->day . ' ' . translateMonth($post->publish_at->month) . ' ' . $post->publish_at->year;

      $post->date = $date;
    }

    return view('pages.home', compact('posts'));
  }

}
