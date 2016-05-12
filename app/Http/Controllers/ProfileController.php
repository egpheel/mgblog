<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use Session;
use File;

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

    if ($request->hasFile('avatar')) {
      $this->validate($request, array('avatar' => 'required|image'));

      if ($user->avatar != 'img/avatar.jpg') {
        File::delete($user->avatar);
      }

      $avatar = $request->file('avatar');
      $avatarName = $user->id . '-' . time() . $avatar->getClientOriginalName();
      $path = "img/profile_pics/";

      $avatar->move($path, $avatarName);

      $user->avatar = $path . $avatarName;
    }

    if ($request->input('name') == $user->name && $request->input('email') == $user->email) {
      $this->validate($request, array('name' => 'required|max:255', 'email' => 'required'));
    } else {
      $this->validate($request, array('name' => 'required|max:255|unique:users', 'email' => 'required|unique:users'));
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->about = $request->about;

    $user->save();

    Session::flash('success', 'O seu perfil foi editado com sucesso.');

    return redirect()->route('profile.show', $user->id);
  }
}
