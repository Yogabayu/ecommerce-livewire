<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
            $mostViewedProducts = DB::table('products as p')
                ->join('detail_products as dp', 'p.id', '=', 'dp.product_id')
                ->select('p.*', 'dp.seeing_count')
                ->orderByDesc('dp.seeing_count')
                ->get();
            // dd($mostViewedProducts);
            return view('pages.admin.dashboard.index', compact(
                'totalAdmin',
                'totalSpv',
                'totalRoles',
                'totalProduct',
                'totalClickProduct',
                'totalShareProduct',
                'mostViewedProducts'
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
            $mostViewedProducts = DB::table('products as p')
                ->join('detail_products as dp', 'p.id', '=', 'dp.product_id')
                ->select('p.*', 'dp.seeing_count')
                ->where('p.user_uuid', auth()->user()->uuid)
                ->orderByDesc('dp.seeing_count')
                ->get();
            return view('pages.admin.dashboard.index', compact('mostViewedProducts', 'totalProduct', 'totalShareProduct', 'totalClickProduct'));
        }
    }
}
