<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //index page for signin
    function index()
    {
        return view('pages.auth.signin');
    }

    //signin function
    function signIn(Request $request)
    {
        // get username and password and validate
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $authenticated = Auth::attempt($credentials);

        if ($authenticated) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    //signout function
    function signOut()
    {
        Auth::logout();
        return redirect()->route('auth.signIn');
    }
}
