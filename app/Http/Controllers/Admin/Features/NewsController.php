<?php

namespace App\Http\Controllers\Admin\Features;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Berita;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class NewsController extends Controller
{
    public function index()
    {
        $sortby = request()->query('sortby');
        $orderby = request()->query('orderby');

        $title = "Kelola Berita";
        $berita = Berita::all();
        $addLocation = route('admin.news.create');
        $editLocation = 'admin.news.edit';
        $deleteLocation = 'admin.news.delete';

        $berita = $sortby && $orderby ? Berita::orderBy($sortby, $orderby)->get() : $berita;

        $sortable = [
            'title' => 'Judul',
            'description' => 'Deskripsi',
            'author' => 'Author',
            'status' => 'Status',
            'created_at' => 'Tanggal',
        ];

        $data = [
            'title' => $title,
            'addLocation' => $addLocation,
            'editLocation' => $editLocation,
            'deleteLocation' => $deleteLocation,
            'berita' => $berita,
            'sortable' => $sortable
        ];

        return view('pages.admin.features.news.index', $data);
    }

    public function create()
    {
        $title = "Tambah Berita";
        $storeLocation = route('admin.news.store');

        $data = [
            'title' => $title,
            'storeLocation' => $storeLocation
        ];

        return view('pages.admin.features.news.create', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'url' => 'required',
            'author' => 'required',
            'status_news' => 'required',
        ]);


        if ($request->hasFile('image_file')) {
            $request->validate([
                'image_file' => 'required|mimes:jpg,jpeg,png,webp|max:2048'
            ]);

            /** @var \CloudinaryLabs\CloudinaryLaravel\Model\Media $cloudinaryResponse */
            $cloudinaryResponse = Cloudinary::upload($request->file('image_file')->getRealPath());
            $resultUrl = $cloudinaryResponse->getSecurePath();

        } else {
            $request->validate([
                'image' => 'required'
            ]);

            $resultUrl = $request->image;
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'url' => $request->url,
            'author' => $request->author,
            'status' => $request->status_news,
            'image_url' => $resultUrl
        ];

        Berita::create($data);

        return redirect()->route('admin.news.index');
    }

    public function edit($id)
    {
        $title = "Edit Berita";
        $berita = Berita::find($id);
        $updateLocation = route('admin.news.update', $id);

        $data = [
            'title' => $title,
            'berita' => $berita,
            'updateLocation' => $updateLocation
        ];

        return view('pages.admin.features.news.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'url' => 'required',
            'author' => 'required',
            'status_news' => 'required',
        ]);

        if ($berita->exists()) {
            if ($request->hasFile('image_file')) {
                $request->validate([
                    'image_file' => 'required|mimes:jpg,jpeg,png,webp|max:2048'
                ]);

                /** @var \CloudinaryLabs\CloudinaryLaravel\Model\Media $cloudinaryResponse */
                $cloudinaryResponse = Cloudinary::upload($request->file('image_file')->getRealPath());
                $resultUrl = $cloudinaryResponse->getSecurePath();

            } else {
                $request->validate([
                    'image' => 'required'
                ]);
                $resultUrl = $request->image;
            }

            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'url' => $request->url,
                'author' => $request->author,
                'status' => $request->status_news,
                'image_url' => $resultUrl
            ];

            $berita->update($data);

            return redirect()->route('admin.news.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $berita = Berita::find($id);

        if ($berita->exists()) {
            $berita->delete();
            return redirect()->route('admin.news.index');
        }
        return redirect()->back();
    }
}
