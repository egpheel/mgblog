<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Session;
use File;

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

    File::delete($post->photo);

    $post->delete();

    Session::flash('success', 'A publicação foi apagada com sucesso.');

    return redirect()->route('posts.index');
  }

  /**
   * Create a new post.
   */
  private function createPost(Request $request)
  {
    $this->validate($request, array('photo' => 'required|image', 'title' => 'required|max:255|unique:posts,title', 'body' => 'required', 'tag_list' => 'required'));

    $photo = $request->file('photo');
    $photoName = time() . $photo->getClientOriginalName();
    $path = "photos/";

    $photo->move($path, $photoName);

    $post = new Post;

    $post->title = $request->title;
    $post->slug = str_slug($request->title, '-');
    $post->body = $request->body;
    $post->photo = $path . $photoName;
    $post->publish_at = $request->publish_at;

    if ($request->featured == '1') {
      $currently_featured = Post::where('featured', 1)->first();
      if (!$currently_featured->isEmpty()) {
        $currently_featured->featured = false;
        $currently_featured->save();
      }
      $post->featured = true;
    } else {
      $post->featured = false;
    }

    $post->save();

    $this->syncTags($post, $request->input('tag_list'));
  }

  /**
   * Update the post.
   */
  private function updatePost(Request $request, $id)
  {
    $post = Post::find($id);

    if ($request->hasFile('photo')) {
      $this->validate($request, array('photo' => 'required|image'));

      File::delete($post->photo);

      $photo = $request->file('photo');
      $photoName = time() . $photo->getClientOriginalName();
      $path = "photos/";

      $photo->move($path, $photoName);

      $post->photo = $path . $photoName;
    }

    if ($request->input('title') == $post->title) {
      $this->validate($request, array('title' => 'required|max:255', 'body' => 'required'));
    } else {
      $this->validate($request, array('title' => 'required|max:255|unique:posts,title', 'body' => 'required'));
    }

    $post->title = $request->title;
    $post->body = $request->body;
    $post->publish_at = $request->publish_at;

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
