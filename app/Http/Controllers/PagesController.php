<?php

namespace App\Http\Controllers;
use App\Post;

class PagesController extends Controller {

  public function getIndex() {
    $posts = Post::orderBy('created_at', 'desc')->paginate(5);

    foreach ($posts as $post) {
      $date = $post->created_at->day . ' ' . translateMonth($post->created_at->month) . ' ' . $post->created_at->year;

      $post->date = $date;
    }

    return view('pages.home', compact('posts'));
  }

}
