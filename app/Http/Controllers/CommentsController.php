<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use Validator;
use Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (Auth::check()) {
        if ($request->ajax()) {
          $validator = Validator::make($request->all(), [
            'text' => 'required',
          ]);

          $comment = new Comment;

          $comment->name = $request->formData['name'];
          $comment->text = $request->formData['text'];
          $comment->status = 0;
          $comment->user_id = $request->formData['id'];
          $comment->post_id = $request->formData['post'];

          $comment->save();

          return response()->json(['id' => $comment->id]);
        } else {
          return 'no ajax :(';
        }
      } else {
        //not authenticated
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      if ($request->ajax()) {
        $comment = Comment::find($id);

        $comment->text = $request->formData['text'];
        $comment->status = '1'; //0 = normal, 1 = edited

        $comment->save();
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $comment = Comment::find($id);

      $comment->delete();
    }
}
