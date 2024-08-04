<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Foundation\Auth\EmailVerificationRequest;



class UserController extends Controller
{
    public function profile()
    {
        $title = 'Profile';
        $updateProfileLocation = route('user.profile.update-profile');
        $updateAvatarLocation = route('user.profile.update-avatar');
        $updateBackgroundLocation = route('user.profile.update-background');
        $updatePasswordLocation = route('user.profile.update-password');
        $perPageQuery = 80;
        $pageQuery = rand(0, (8000 / $perPageQuery));
        $apiQuery = 'abstract';
        $images = Http::withHeaders([
            'Authorization' => env('PEXELS_API_KEY')
        ])->accept('application/json')->retry(3, 100)->withQueryParameters([
                    'query' => $apiQuery,
                    'page' => $pageQuery,
                    'per_page' => $perPageQuery,
                    'orientation' => 'landscape'
                ])->get("https://api.pexels.com/v1/search?")->json();


        $dataImage = [];
        foreach ($images['photos'] as $image) {
            $dataImage[] = $image['src']['original'];
        }

        $data = [
            'title' => $title,
            'images' => $dataImage,
            'user' => Auth::user(),
            'updateAvatarLocation' => $updateAvatarLocation,
            'updateBackgroundLocation' => $updateBackgroundLocation,
            'updatePasswordLocation' => $updatePasswordLocation,
            'updateProfileLocation' => $updateProfileLocation,
        ];
        if (Auth::user()->role == 'admin') {
            return view('pages.user.profile', $data);
        }

        return view('pages.user.profileUser', $data);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'nkk' => 'required|max:16|unique:users,nkk,' . Auth::user()->id,
            'address' => 'required|min:5',
        ]);

        $user = Auth::user();
        $userMain = User::find($user->id);

        $userMain->update([
            'name' => $request->name,
            'email' => $request->email,
            'nkk' => $request->nkk,
            'address' => $request->address,
        ]);

        $userMain->save();

        return redirect()->back();
    }

    public function updateAvatar(Request $request)
    {

        $request->validate([
            'image_avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $user = Auth::user();
        $userMain = User::find($user->id);


        /** @var \CloudinaryLabs\CloudinaryLaravel\Model\Media $cloudinaryResponse */
        $cloudinaryResponse = Cloudinary::upload($request->file('image_avatar')->getRealPath());
        $resultUrl = $cloudinaryResponse->getSecurePath();

        $userMain->update([
            'url_avatar' => $resultUrl,
        ]);

        $userMain->save();

        return redirect()->route('user.profile.index');
    }

    public function saveBackgroundProfile(Request $request)
    {
        $request->validate([
            'image_back' => 'required',
        ]);

        $user = Auth::user();
        $userMain = User::find($user->id);



        $userMain->update([
            'url_image' => $request->image_back,
        ]);

        $userMain->save();

        return redirect()->route('user.profile.index');


    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'new_password_confirmation' => 'required',
        ]);

        $user = User::find(Auth::user()->id);

        if (!$user) {
            session()->flash('danger', ['title' => 'Update Failed.', 'description' => 'Update Failed.']);
        } else {
            if (request()->new_password != $request->new_password_confirmation) {
                session()->flash('danger', ['title' => 'Update Failed - Passwords do not match.', 'description' => 'Update Failed - Passwords do not match.']);
            } else if (!password_verify($request->current_password, $user->password)) {
                session()->flash('danger', ['title' => 'Update Failed - Current password is incorrect.', 'description' => 'Update Failed - Current password is incorrect.']);
            } else {
                $newPassword = Hash::make($request->new_password);
                $user->password = $newPassword;
                $user->save();

                session()->flash('success', ['title' => 'Update Success.', 'description' => 'Update Success.']);
            }
        }

        return redirect()->route('user.profile.index');
    }

    public function verifyEmail()
    {
        $user = User::find(auth()->id());
        $verifyEmailLocation = route('verification.send');

        $data = [
            'user' => $user,
            'verifyEmailLocation' => $verifyEmailLocation,
        ];

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('user.profile.index');
        }

        return view('pages.user.verifyEmail', $data);
    }

    public function sendEmailVerification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function verifyEmailToken(EmailVerificationRequest $request)
    {
        $request->fulfill();

        $user = User::find(auth()->id());

        $user->getRedirectByRole();
    }

}
