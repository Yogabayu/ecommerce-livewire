<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            return view('layouts.guest.main');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
