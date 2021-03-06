<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function loginPage(Request $request)
    {
        if (Auth::check()) {
			return redirect('/');
        }else{
            return view('auth.login');
        }
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
		
		$remember = false;
		
		if($request->input('remember') === '1'){
			$remember = true;
		}

        if (Auth::attempt($credentials , $remember)) {
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
		$user->show_completed = 0;
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

    public function forgotPasswordPage () {
        return view('auth.forgot-password');
    }

    public function sendResestLink (Request $request) {
        $request->validate(['email' => 'required|email']);
    
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordPage ($token) 
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
