<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function changeVisibility($id)
    {
        try {
            $banner = Banner::where('id', $id)->first();
            $cekIsSee = Banner::where('is_see', 1)->count();
            if ($cekIsSee == 2 && $banner->is_see != 1) {
                return redirect()->back()->with("error", "Tidak bisa mengubah status banner karena telah ada 2 banner yang ditayangkan, ubah data dahulu data lama");
            }
            if ($banner->is_see == 1) {
                $banner->is_see = 0;
            } else {
                $banner->is_see = 1;
            }
            $banner->save();

            return redirect()->back()->with('success', 'Banner updated successfully!');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $banners = Banner::all();

            return view("pages.admin.banner.index", compact("banners"));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'banner_img' => 'required|mimes:jpeg,jpg,png|max:2048',
                'is_see' => 'required',
                'url' => 'url:http,https',
            ]);

            $cekIsSee = Banner::where('is_see', 1)->count();
            if ($cekIsSee == 2 && $request->is_see == 1) {
                return redirect()->back()->with("error", "Tidak bisa menambahkan banner karena telah ada 2 banner yang ditayangkan, ubah data dahulu data lama");
            }

            // Save the photo to the storage
            $extension = $request->file('banner_img')->extension();
            $imgname = date('dmyHis') . '.' . $extension;
            $path = Storage::putFileAs('public/banners', $request->file('banner_img'), $imgname);

            // Create a new banner
            Banner::create([
                'banner_img' => $imgname,
                'is_see' => $request->is_see,
                'url' => $request->url,
                // 'is_hero' => $request->is_hero,
            ]);

            return redirect()->back()->with('success', 'Banner added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'banner_img' => 'mimes:jpeg,jpg,png|max:2048',
                'is_see' => 'required',
                'url' => 'url:http,https',
            ]);

            $bannerEdit = Banner::where('id', $id)->first();
            $cekIsSee = Banner::where('is_see', 1)->count();
            if ($cekIsSee == 2 && $request->is_see == 1 && $bannerEdit->is_see != 1) {
                return redirect()->back()->with("error", "Tidak bisa menambahkan banner karena telah ada 2 banner yang ditayangkan, ubah data dahulu data lama");
            }
            $banner = Banner::findOrFail($id);
            $banner->is_see = $request->is_see;
            $banner->url = $request->url;

            if ($request->hasFile('banner_img')) {
                if ($banner->banner_img) {
                    Storage::delete("public/banners/{$banner->banner_img}");
                }

                // Save the photo to the storage
                $extension = $request->file('banner_img')->extension();
                $imgname = date('dmyHis') . '.' . $extension;
                $path = $request->file('banner_img')->storeAs('public/banners', $imgname);

                $banner->banner_img = $imgname;
            }

            $banner->save();
            return redirect()->back()->with('success', 'Banner updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $banner = Banner::where('id', $id)->first();

            if ($banner) {
                $banner->delete();
                Storage::delete("public/banners/{$banner->banner_img}");
                return redirect()->back()->with('success', 'Banner deleted successfully.');
            }

            return redirect()->back()->with('error', 'Unknown Banner Data');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
