<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view("register");
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'picture' => 'nullable|image|max:2048'
        ]);
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('avatars', 'public');
            $data['avatar'] = $path;
        }
        $user = User::create([
            'name'=> $data['name'],
            'email'=> $data['email'],
            'password'=> Hash::make($data['password']),
            'picture'=> $data['avatar']??null,
        ]);
        return redirect()->route('home')->with('success','Account created');
    }

}
