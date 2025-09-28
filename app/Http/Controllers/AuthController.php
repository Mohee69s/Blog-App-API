<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $credintials = $request->validate([
            "email" => 'required|email',
            "password" => 'required',
        ]);
        if (Auth::attempt($credintials)){
            $request->session()->regenerate();
            return redirect("/home");
        }
        return back()->withErrors(["email"=> "invalid credintials"])->onlyInput('email');
    }
    public function destroy(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/login');
    }
    public function index(){
        return view('login');
    }
    
}
