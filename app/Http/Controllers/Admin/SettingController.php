<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $setting = Setting::first();

            return view("pages.admin.setting.index", compact("setting"));
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
            //code...
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
                'name_app' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'main_tlp' => 'required|string|max:20',
                'ig' => 'required|string|max:255',
                'fb' => 'required|string|max:255',
                'wa' => 'required|string|max:20',
                'version' => 'required|string|max:20',
                'logo' => 'mimes:jpeg,jpg,png|max:2048',
            ]);

            $setting = Setting::findOrFail($id);

            $data = [
                'name_app' => $request->name_app,
                'address' => $request->address,
                'email' => $request->email,
                'main_tlp' => $request->main_tlp,
                'ig' => $request->ig,
                'fb' => $request->fb,
                'wa' => $request->wa,
                'version' => $request->version,
                'desc' => $request->desc,
            ];

            if ($request->hasFile('logo')) {
                $data['logo'] = $this->uploadLogo($request->file('logo'), $setting->logo);
            }

            $setting->update($data);

            return redirect()->back()->with('success', 'Berhasil melakukan update pengaturan aplikasi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function uploadLogo($file, $oldLogo = null)
    {
        $extension = $file->extension();
        $imgname = date('dmyHis') . '.' . $extension;
        $path = $file->storeAs('public/setting', $imgname);

        // Remove the old photo if exists
        if ($oldLogo) {
            Storage::delete("public/setting/{$oldLogo}");
        }

        return $imgname;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            //code...
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
