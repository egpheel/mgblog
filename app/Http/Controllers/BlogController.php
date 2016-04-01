<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function getPublicacao($year, $month, $slug)
    {
      try {
        $post = Post::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->where('slug', '=', $slug)->first();

        $date = $post->created_at->day . ' ' . $this->translateMonth($post->created_at->month) . ' ' . $post->created_at->year;

        $post->date = $date;

        return view('blog.publicacao')->with(compact('post'));
      } catch (\Exception $e) {
        abort(404);
      }
    }

    public function getArchive($year, $month)
    {
      $posts = Post::latest()->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->paginate(5);

      foreach ($posts as $post) {
        $date = $post->created_at->day . ' ' . $this->translateMonth($post->created_at->month) . ' ' . $post->created_at->year;

        $post->date = $date;
      }

      $archive_date = $this->translateMonth($month) . ' ' . $year;

      return view('archives.show')->with(compact('posts', 'archive_date'));
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
