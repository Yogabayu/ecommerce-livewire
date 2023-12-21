<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            $totalAdmin = DB::table('users')->where('role_id', 1)->count();
            $totalSpv = DB::table('users')->where('role_id', 2)->count();
            $totalRoles = DB::table('roles')->count();
            $totalProduct = DB::table('products')->count();
            $totalClickProduct = DB::table('detail_products')->where('seeing_count', '!=', 0)->sum('seeing_count');
            $totalShareProduct = DB::table('detail_products')->where('share_count', '!=', 0)->sum('share_count');
            return view('pages.admin.dashboard.index', compact(
                'totalAdmin',
                'totalSpv',
                'totalRoles',
                'totalProduct',
                'totalClickProduct',
                'totalShareProduct'
            ));
        } else {
            $totalProduct = DB::table('products')->where('user_uuid', auth()->user()->uuid)->count();
            $totalClickProduct = DB::table('products')
                ->join('detail_products', 'products.id', '=', 'detail_products.product_id')
                ->where('products.user_uuid', auth()->user()->uuid)
                ->where('detail_products.seeing_count', '!=', 0)
                ->sum('detail_products.seeing_count');
            $totalShareProduct = DB::table('products')
                ->join('detail_products', 'products.id', '=', 'detail_products.product_id')
                ->where('products.user_uuid', auth()->user()->uuid)
                ->where('detail_products.share_count', '!=', 0)
                ->sum('detail_products.share_count');
            return view('pages.admin.dashboard.index', compact('totalProduct', 'totalShareProduct', 'totalClickProduct'));
        }
    }
}
