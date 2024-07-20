<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AdminController extends Controller
{
    function dashboard()
    {
        $title = 'Dashboard';

        $data = [
            'title' => $title,

        ];

        return view('pages.admin.dashboard', $data);
    }

    public function profile()
    {
        $title = 'Profile';
        $updateAvatarLocation = route('admin.profile.update-avatar');
        $updateBackgroundLocation = route('admin.profile.update-background');
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
            'updateBackgroundLocation' => $updateBackgroundLocation
        ];

        return view('pages.user.profile', $data);
    }

    public function updateAvatar(Request $request)
    {

        $request->validate([
            'image_avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
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

        return redirect()->route('admin.profile.index');
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

        return redirect()->route('admin.profile.index');


    }
}
