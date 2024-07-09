<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'hbkey' => 'required|unique:users',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_birth' => 'required|date',
            'address' => 'required|string',
            'role' => 'required|string',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|unique:users',
        ]);

        $user = User::create([
            'hbkey' => $request->hbkey,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_birth' => $request->date_birth,
            'address' => $request->address,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'mobile_phone' => $request->mobile_phone,
            'email' => $request->email,
        ]);

        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'hbkey' => 'required|unique:users,hbkey,' . $user->id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_birth' => 'required|date',
            'address' => 'required|string',
            'role' => 'required|string',
            'password' => 'sometimes|string|min:8',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->all());

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }
}
