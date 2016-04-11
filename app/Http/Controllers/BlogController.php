<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Tag;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function getPublicacao($year, $month, $slug)
    {
      try {
        $post = Post::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->where('slug', '=', $slug)->published()->first();

        $date = $post->created_at->day . ' ' . translateMonth($post->created_at->month) . ' ' . $post->created_at->year;

        $post->date = $date;

        return view('blog.publicacao', compact('post'));
      } catch (\Exception $e) {
        abort(404);
      }
    }

    public function getArchive($year, $month)
    {
      $posts = Post::latest('publish_at')->published()->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->paginate(5);

      foreach ($posts as $post) {
        $date = $post->created_at->day . ' ' . translateMonth($post->created_at->month) . ' ' . $post->created_at->year;

        $post->date = $date;
      }

      $archive_date = translateMonth($month) . ' ' . $year;

      if ($posts->isEmpty()) {
        abort(404);
      } else {
        return view('archives.show')->with(compact('posts', 'archive_date'));
      }
    }

    public function getTag($tag)
    {
      $tags = Tag::where('name', $tag)->first();

      $posts = $tags->posts_paginated;

      if ($posts->isEmpty()) {
        abort(404);
      } else {
        return view('tags.show', compact('tags', 'posts'));
      }
    }
}
