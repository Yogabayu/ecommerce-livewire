<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('pages.admin.auth');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function actionLogin(Request $request)
    {
        try {
            $request->validate([
                'email'     => 'required|email',
                'password'  => 'required',
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('dashboard.index')->with('success', 'berhasil login sebagai admin');
            } else {
                return back()->with('error', 'email and password are wrong.');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
