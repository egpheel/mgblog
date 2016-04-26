<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
  protected $dates = ['publish_at'];
  protected $fillable = ['user_id'];

  public function scopeFeatured($query)
  {
    $query->where('featured', 1);
  }

  public function scopeUnfeatured($query)
  {
    $query->where('featured', 0);
  }

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
   * Usage: e.g. $post->tags
   */

  public function tags()
  {
    return $this->belongsToMany('App\Tag')->withTimestamps();
  }

  /**
   * Get the author of the given post.
   * Usage: e.g. $post->user
   */
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  /**
   * Get the comments of the given post.
   * Usage: e.g. $post->comments
   */
  public function comments()
  {
    return $this->hasMany('App\Comment');
  }

  /**
   * Get a list of tag IDs associated with the current article.
   */

  public function getTagListAttribute()
  {
    return $this->tags->lists('id')->all();
  }
}
