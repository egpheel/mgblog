<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  /**
   * Get the tags associated with the given post.
   */

  public function tags()
  {
    return $this->belongsToMany('App\Tag')->withTimestamps();
  }

  /**
   * Get a list of tag IDs associated with the current article.
   */

  public function getTagListAttribute()
  {
    return $this->tags->lists('id')->all();
  }
}
