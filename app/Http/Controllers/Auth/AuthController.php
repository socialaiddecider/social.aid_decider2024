<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //index page for signin
    function index()
    {
        $actionLocation = route('auth.postSignIn');

        return view('pages.auth.signin', compact('actionLocation'));
    }

    //signin function
    function signIn(Request $request)
    {
        // get username and password and validate
        $credentials = $request->validate([
            'username' => 'bail|required|min:6',
            'password' => 'required|min:6',
        ]);

        if ($request->remember) {
            $remember = true;
        } else {
            $remember = false;
        }

        // check if user exists
        $authenticated = Auth::attempt($credentials, $remember);

        if (Auth::viaRemember()) {
            $authenticated = true;
        }

        if ($authenticated) {
            $request->session()->regenerate();

            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('index');
        }
        $request->flashOnly('username');

        return back()->withErrors([
            'username' => 'incorrect username or password.',
            'password' => 'The provided credentials do not match our records.',
        ]);
    }

    public function signUp()
    {
        $actionLocation = route('auth.register');

        return view('pages.auth.signup', compact('actionLocation'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6',
            'username' => 'required|min:6',
            'nik' => 'required|min:15',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->nik = $request->nik;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';
        $user->url_avatar = 'https://api.dicebear.com/9.x/big-ears-neutral/svg?seed=' . $request->name;
        $user->save();

        return redirect()->route('auth.signIn');
    }

    //signout function
    function signOut()
    {
        Auth::logout();
        return redirect()->route('auth.signIn');
    }
}
