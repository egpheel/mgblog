<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
  protected $dates = ['publish_at'];

  /**
   * Scope to show only the published items.
   */
  public function scopePublished($query)
  {
    $query->where('publish_at', '<=', Carbon::now());
  }

  /**
   * Scope to show only the unpublished items.
   */
  public function scopeUnpublished($query)
  {
    $query->where('publish_at', '>=', Carbon::now());
  }

  /**
   * Set the publish_at attribute.
   */
  public function setPublishAtAttribute($date)
  {
    $this->attributes['publish_at'] = Carbon::parse($date);
  }

  /**
   * Get the publish_at attribute.
   */
  public function getPublishAtAttribute($date)
  {
    return new Carbon($date);
  }

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
