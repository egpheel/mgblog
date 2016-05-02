<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use App\Role;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'avatar_vid', 'about',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the posts of a given user.
     * Usage: e.g. $user->posts
     */
    public function posts()
    {
      return $this->hasMany('App\Post');
    }

    /**
     * Get the comments of a given user.
     * Usage: e.g. $user->comments
     */
    public function comments()
    {
      return $this->hasMany('App\Comment');
    }

    /**
     * Get the roles of a given user.
     * Usage: e.g. $user->roles
     */
    public function roles()
    {
      return $this->belongsToMany('App\Role');
    }

    /**
     * Check if a user has a certain role.
     * Usage: e.g. $user->hasRole('admin')
     *
     * Returns boolean
     */
    public function hasRole($check)
    {
      return in_array($check, array_pluck($this->roles->toArray(), 'name'));
    }

    public function assignRole($role)
    {
      $role_id = Role::where('name', '=', $role)->first();

      return $this->roles()->attach($role_id);
    }
}
