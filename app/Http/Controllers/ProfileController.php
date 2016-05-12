<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

class ProfileController extends Controller
{
  public function showProfile($id) {
    $user = User::findOrFail($id);

    $date = $user->created_at->day . ' ' . translateMonth($user->created_at->month) . ' ' . $user->created_at->year;

    $user->date = $date;

    return view('profile.show', compact('user'));
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
    $user = User::find($id);

    return $request;
  }
}
