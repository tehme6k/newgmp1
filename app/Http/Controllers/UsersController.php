<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index')->with('users', User::all());
    }

    public function store(AddUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'created_by' => auth()->user()->id
        ]);

        session()->flash('success', 'User added!');

        return back();
    }

    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        session()->flash('success', 'Item Approved');

        return back();
    }

    public function destroy($id)
    {
        //
    }
}
