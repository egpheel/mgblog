<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Session;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $posts = Post::orderBy('created_at', 'desc')->paginate(10);

    return view('posts.index')->with('posts', $posts);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $tags = Tag::orderBy('name', 'asc')->lists('name', 'id');

    return view('posts.create', compact('tags'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->createPost($request);

    Session::flash('success', 'A publicação foi criada com sucesso.');

    return redirect()->route('posts.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $post = Post::find($id);

    return view('posts.show')->with('post', $post);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $post = Post::find($id);
    $tags = Tag::orderBy('name', 'asc')->lists('name', 'id');

    return view('posts.edit', compact('post', 'tags'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->updatePost($request, $id);

    $post = Post::find($id);

    $this->syncTags($post, $request->input('tag_list'));

    Session::flash('success', 'A publicação foi editada com successo.');

    return redirect()->route('posts.show', $post->id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $post = Post::find($id);

    $post->delete();

    Session::flash('success', 'A publicação foi apagada com sucesso.');

    return redirect()->route('posts.index');
  }

  /**
   * Create a new post.
   */
  private function createPost(Request $request)
  {
    $this->validate($request, array('title' => 'required|max:255|unique:posts,title', 'body' => 'required'));

    $post = new Post;

    $post->title = $request->title;
    $post->slug = str_slug($request->title, '-');
    $post->body = $request->body;

    $post->save();

    $this->syncTags($post, $request->input('tag_list'));
  }

  /**
   * Update the post.
   */
  private function updatePost(Request $request, $id)
  {
    $this->validate($request, array('title' => 'required|max:255', 'body' => 'required'));

    $post = Post::find($id);

    $post->title = $request->input('title');
    $post->body = $request->input('body');

    $post->save();
  }

  /**
   * Sync the list of tags in the DB.
   */
  private function syncTags(Post $post, array $tags)
  {
    $syncTagsList = $this->checkForNewTags($tags);

    $post->tags()->sync($syncTagsList);
  }


  private function checkForNewTags(array $tags_id)
	{
		$allDBTags = Tag::lists('id')->toArray(); // get all the tags in the db

		$newTagsList = array_diff($tags_id, $allDBTags);

		$syncTagsList = array_diff($tags_id, $newTagsList);

		foreach ($newTagsList as $newTag)
		{
			// create a new tag

			$newTagModel = Tag::create(['name' => $newTag]);

			$syncTagsList[] = $newTagModel->id;

		}

		return $syncTagsList;
	}

}
