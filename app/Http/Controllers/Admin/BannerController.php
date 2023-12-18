<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
                'is_hero' => 'required',
            ]);

            // Check if there's already a hero image
            $cekHero = Banner::where('is_hero', 1)->count();
            if ($cekHero > 0 && $request->is_hero) {
                return redirect()->back()->with('error', 'Hanya satu gambar yang dapat dijadikan hero image, mohon ganti terlebih dahulu');
            }

            // Save the photo to the storage
            $extension = $request->file('banner_img')->extension();
            $imgname = date('dmyHis') . '.' . $extension;
            $path = Storage::putFileAs('public/banners', $request->file('banner_img'), $imgname);

            // Create a new banner
            Banner::create([
                'banner_img' => $imgname,
                'is_see' => $request->is_see,
                'is_hero' => $request->is_hero,
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
                'is_hero' => 'required',
            ]);

            $cekHeroCount = Banner::where('is_hero', 1)->count();

            if ($cekHeroCount == 1) {
                return redirect()->back()->with('error', 'Hanya satu gambar yang dapat dijadikan hero image, mohon ganti terlebih dahulu');
            }
            $banner = Banner::findOrFail($id);
            $banner->is_see = $request->is_see;
            $banner->is_hero = $request->is_hero;

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
