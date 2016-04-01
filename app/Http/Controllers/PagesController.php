<?php

namespace App\Http\Controllers;
use App\Post;

class PagesController extends Controller {

  public function getIndex() {
    $posts = Post::orderBy('created_at', 'desc')->paginate(5);

    foreach ($posts as $post) {
      $date = $post->created_at->day . ' ' . $this->translateMonth($post->created_at->month) . ' ' . $post->created_at->year;

      $post->date = $date;
    }

    return view('pages.home', compact('posts'));
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
