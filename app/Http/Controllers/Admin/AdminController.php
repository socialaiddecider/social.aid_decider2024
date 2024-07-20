<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\DataAsli;
use App\Models\Penilaian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class AdminController extends Controller
{
    function dashboard()
    {
        $title = 'Dashboard';
        $alternatifCount = Alternatif::count();
        $kriteriaCount = Kriteria::count();
        $totalData = DataAsli::count();
        $menerimaCount = DataAsli::where('status', 'Menerima')->count();

        $penilaian = Penilaian::select('nilai', 'created_at')->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });

        $dataPenilaian = [];
        for ($i = 0; $i < 12; $i++) {
            $dataPenilaian[$i] = 0;
        }

        foreach ($penilaian as $key => $result) {
            $index = (int) ($key) - 1;
            foreach ($result as $item) {
                $dataPenilaian[$index] += $item->nilai;
            }

            $dataPenilaian[$index] = $dataPenilaian[$index] / count($result);

        }

        $data = [
            'title' => $title,
            'alternatifCount' => $alternatifCount,
            'kriteriaCount' => $kriteriaCount,
            'totalData' => $totalData,
            'menerimaCount' => $menerimaCount,
            'dataPenilaian' => $dataPenilaian
        ];

        return view('pages.admin.dashboard', $data);
    }

    public function profile()
    {
        $title = 'Profile';
        $updateAvatarLocation = route('admin.profile.update-avatar');
        $updateBackgroundLocation = route('admin.profile.update-background');
        $updatePasswordLocation = route('admin.profile.update-password');
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
            'updatePasswordLocation' => $updatePasswordLocation
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

        return redirect()->route('admin.profile.index');
    }
}
