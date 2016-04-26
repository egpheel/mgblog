<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = [
    'name', 'text', 'status',
  ];

  /**
   * Get the post of a given comment.
   * Usage: e.g. $comment->post
   */
  public function post() {
    return $this->belongsTo('App\Post');
  }
}
