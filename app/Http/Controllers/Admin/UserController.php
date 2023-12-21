<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function updateUser(Request $request, $uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->first();

            $request->validate([
                'role_id' => 'required',
                'nik' => [
                    'required',
                    Rule::unique('users')->ignore($user->id),
                ],
                'name' => 'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($user->id),
                ],
                'password' => 'nullable|min:8',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
            ]);

            $user->role_id = $request->role_id;
            $user->nik = $request->nik;
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('photo')) {
                // Save the photo to the storage
                $extension = $request->file('photo')->extension();
                $imgname = date('dmyHis') . '.' . $extension;
                $path = $request->file('photo')->storeAs('public/photos', $imgname);

                // Remove the old photo if exists
                if ($user->photo) {
                    Storage::delete("public/photos/{$user->photo}");
                }

                $user->photo = $imgname;
            }

            $user->save();

            return redirect()->back()->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating user');
        }
    }
    public function showUser($uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->firstOrFail();
            $roles = Role::all();

            return view('pages.admin.user.profile.index', compact('user', 'roles'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error showing detail user');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::all();
            $roles = Role::all();

            return view('pages.admin.user.index', compact('users', 'roles'));
        } catch (\Exception $e) {
            dd($e->getMessage());
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
                'role_id' => 'required',
                'photo' => 'required|mimes:jpeg,jpg,png|max:2048',
                'nik' => [
                    'required',
                    Rule::unique('users')->ignore($request->user_id)->whereNull('deleted_at'),
                    'min:6',
                ],
                'name' => 'required',
                'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
                'password' => 'required|min:8',
            ]);

            // Save the photo to the storage
            $extension = $request->file('photo')->extension();
            $imgname = date('dmyHis') . '.' . $extension;
            $path = Storage::putFileAs('public/photos', $request->file('photo'), $imgname);

            // Create a new user
            User::create([
                'role_id' => $request->role_id,
                'uuid' => Str::uuid(),
                'nik' => $request->nik,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'photo' => $imgname,
            ]);

            return redirect()->back()->with('success', 'User added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
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
    public function update(Request $request, string $uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->first();

            $request->validate([
                'role_id' => 'required',
                'nik' => [
                    'required',
                    Rule::unique('users')->ignore($user->id),
                ],
                'name' => 'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($user->id),
                ],
                'password' => 'nullable|min:8',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
            ]);

            $user->role_id = $request->role_id;
            $user->nik = $request->nik;
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('photo')) {
                // Save the photo to the storage
                $extension = $request->file('photo')->extension();
                $imgname = date('dmyHis') . '.' . $extension;
                $path = $request->file('photo')->storeAs('public/photos', $imgname);

                // Remove the old photo if exists
                if ($user->photo) {
                    Storage::delete("public/photos/{$user->photo}");
                }

                $user->photo = $imgname;
            }

            $user->save();

            return redirect()->back()->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->first();

            if ($user) {
                $user->delete();
                return redirect()->back()->with('success', 'User deleted successfully.');
            }

            return redirect()->back()->with('error', 'Unknown User Data');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
