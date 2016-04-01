<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  protected $fillable = [
    'name'
  ];

  /**
   * Get the posts associated with the given tag.
   */
  public function posts()
  {
    return $this->belongsToMany('App\Post');
  }
}
