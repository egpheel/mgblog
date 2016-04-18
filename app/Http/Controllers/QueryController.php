<?php

namespace App\Http\Controllers;
use App\Post;

use Illuminate\Http\Request;

use App\Http\Requests;

class QueryController extends Controller
{
  public function getResults(Request $request)
  {
    $this->validate($request, ['pesquisa' => 'required|min:3']);

    $query = $request->pesquisa;

    $keywords = preg_split('/\s+/', $query);

    foreach ($keywords as $key => $keyword) {
      if (strlen($keyword) < 3) {
        unset($keywords[$key]);
      }
    }

    $posts = Post::latest()->where(function ($q) use ($keywords) {
      foreach ($keywords as $keyword) {
        $q->orWhere('title', 'LIKE', '%' . $keyword . '%');
      }
    })->orWhere(function ($q) use ($keywords) {
      foreach ($keywords as $keyword) {
        $q->orWhere('body', 'LIKE', '%' . $keyword . '%');
      }
    })->published()->paginate(5);

    return view('pages.results', compact('posts', 'query'));
  }
}
