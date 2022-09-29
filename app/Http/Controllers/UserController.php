<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserRemoved;
use App\Notifications\UserCreated;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'sometimes|min:6|confirmed',
        ]);

        $input = $request->except(['photo']);

        // photo is uploaded to 'storage/public/avatars'
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = $photo->hashName();
            $photo->storeAs('avatars', $filename, 'public');
            $input['photo'] = $filename;
        }

        $user = User::create($input);
        $user->notify(new UserCreated($user->phone));

        return redirect()
                ->route('users.index')
                ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
            'password' => 'sometimes|min:6|confirmed',
        ]);

        $input = $request->except(['photo']);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = $photo->hashName();
            $photo->storeAs('avatars', $filename, 'public');
            $input['photo'] = $filename;
        }

        $user->update($input);

        return redirect()
                ->route('users.index')
                ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        $user->notify(new UserRemoved($user->phone));

        return redirect()
                ->route('users.index')
                ->with('success', 'User deleted successfully');
    }
}
