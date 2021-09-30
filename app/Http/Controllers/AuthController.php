<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function signupPage()
    {
        return view('auth.signup');
    }

    public function register(Request $request)
    {
        $this->validate($request , [
            'email' => ['required' , 'unique:App\Models\User,email'],
            'password' => ['required','confirmed']            
        ],[
            'email' => 'Email is required.',
            'password.required' => 'Password is required.'
        ]);

        $user = new \App\Models\User();
        $user->name = $request->input('email');
        $user->email = $request->input('email');
        $user->password=bcrypt($request->input('password'));
        $user->save();

        return redirect('/')->with('success' , 'User created successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
