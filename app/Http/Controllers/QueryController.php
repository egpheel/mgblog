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

    $posts = Post::latest()->where('title', 'LIKE', '%' . $query . '%')->orWhere('body', 'LIKE', '%' . $query . '%')->published()->paginate(5);

    return view('pages.results', compact('posts', 'query'));
  }
}
