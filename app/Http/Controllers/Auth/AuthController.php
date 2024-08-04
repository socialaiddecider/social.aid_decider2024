<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    //index page for signin
    function index()
    {
        $actionLocation = route('auth.postSignIn');
        $forgetPasswordLocation = route('auth.forgotPassword');
        $cardImagePath = 'resources/assets/images/beranda/signInImageCard.jpg';
        $backgroundImagePath = 'resources/assets/images/beranda/signInImageBg.jpg';

        $data = [
            'actionLocation' => $actionLocation,
            'forgetPasswordLocation' => $forgetPasswordLocation,
            'cardImagePath' => $cardImagePath,
            'backgroundImagePath' => $backgroundImagePath,
        ];

        return view('pages.auth.signin', $data);
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

            /**
             * @var User $user
             */
            $user = Auth::user();

            //verify email check
            if (!$user->hasVerifiedEmail()) {
                return redirect()->route('verification.notice');

            }

            // redirect user based on role
            $user->getRedirectByRole();
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
        $cardImagePath = 'resources/assets/images/beranda/signInImageCard.jpg';
        $backgroundImagePath = 'resources/assets/images/beranda/signInImageBg.jpg';

        $data = [
            'actionLocation' => $actionLocation,
            'cardImagePath' => $cardImagePath,
            'backgroundImagePath' => $backgroundImagePath,
        ];

        return view('pages.auth.signup', $data);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6',
            'username' => 'required|min:6|unique:users,username',
            'nkk' => 'required|max:16|unique:users,nkk',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->nkk = $request->nkk;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';
        $user->url_avatar = 'https://api.dicebear.com/9.x/big-ears-neutral/svg?seed=' . $request->name;
        $user->save();

        event(new Registered($user));

        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        return redirect()->route('auth.signIn');
    }

    public function forgotPassword()
    {
        $actionLocation = route('auth.changePassword');
        $cardImagePath = 'resources/assets/images/beranda/signInImageCard.jpg';
        $backgroundImagePath = 'resources/assets/images/beranda/signInImageBg.jpg';

        $data = [
            'actionLocation' => $actionLocation,
            'cardImagePath' => $cardImagePath,
            'backgroundImagePath' => $backgroundImagePath,
        ];
        return view('pages.auth.forgotPassword', $data);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found']);
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        $move = $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);

        return $move;
    }

    public function resetPassword(string $token)
    {
        $actionLocation = route('password.update');
        $cardImagePath = 'resources/assets/images/beranda/signInImageCard.jpg';
        $backgroundImagePath = 'resources/assets/images/beranda/signInImageBg.jpg';

        $data = [
            'token' => $token,
            'actionLocation' => $actionLocation,
            'cardImagePath' => $cardImagePath,
            'backgroundImagePath' => $backgroundImagePath,
        ];

        return view('pages.auth.resetPassword', $data);
    }

    public function doResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
                event(new PasswordReset($user));
            }
        );

        $move = $status == Password::PASSWORD_RESET
            ? redirect()->route('auth.signIn')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);

        return $move;
    }

    //signout function
    function signOut()
    {
        Auth::logout();
        return redirect()->route('auth.signIn');
    }
}
