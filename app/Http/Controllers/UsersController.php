<?php

namespace App\Http\Controllers;

use App\User;
use App\UserType;
use Illuminate\Http\Request;
use Auth;
use DB;
use Validator;
use Session;
use Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->authorize('viewAny', User::class);

      $users = User::all();

      return view('user.indexuser', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $this->authorize('create', User::class);

      $types = UserType::all();

      return view('user.createuser', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->authorize('create', User::class);

      $validator = Validator::make(request()->all(), [
        'firstname' => 'required',
        'lastname' => 'required',
        'username' => 'required',
        'email' => 'required',
        'password' => 'required',
        'password_confirmation' => 'required'
      ]);

      if ($validator->fails()) {
          return redirect('/users/create')
            ->withErrors($validator)
            ->withInput();
      }

      $user = new User();
      $user->firstname = request('firstname');
      $user->lastname = request('lastname');
      $user->username = request('username');
      $user->email = request('email');
      $user->user_type_id = request('type');
      $user->password = Hash::make(request('password'));
      $user->save();

      return redirect('/users/' . $user->id)->with('created', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
      $this->authorize('view', User::class);

      $type = UserType::where('id', $user->user_type_id)->first();

      return view('user.showuser', compact('user', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
      $this->authorize('update', User::class);

      $types = UserType::all();

      return view('user.edituser', compact('user', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      $this->authorize('update', User::class);

      $validator = Validator::make(request()->all(), [
        'firstname' => 'required',
        'lastname' => 'required',
        'username' => 'required',
        'email' => 'required',
        'password' => 'required',
        'password_confirmation' => 'required'
      ]);

      if ($validator->fails()) {
          return redirect('/users/create')
            ->withErrors($validator)
            ->withInput();
      }

      $user->firstname = request('firstname');
      $user->lastname = request('lastname');
      $user->username = request('username');
      $user->email = request('email');
      $user->user_type_id = request('type');
      $user->password = Hash::make(request('password'));
      $user->save();

      return redirect('/users/' . $user->id)->with('updated', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
      $this->authorize('delete', User::class);

      $user->delete();

      return redirect('/users')->with('deleted', $user);
    }
}
