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
   * Usage: e.g. $tag->posts
   */
  public function posts()
  {
    return $this->belongsToMany('App\Post');
  }

  /**
   * Get the posts associated with the given tag.
   * Paginated version.
   * Usage: e.g. $tag->posts_paginated
   */
  public function getPostsPaginatedAttribute()
  {
    return $this->posts()->latest()->published()->paginate(5);
  }

  /**
   * Get random tags.
   * Usage: e.g. $tag->random()
   */
  public function scopeRandom($query) {
    return $query->orderByRaw('RAND()');
  }
}
