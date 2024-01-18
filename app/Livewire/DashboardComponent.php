<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class DashboardComponent extends Component
{
    public $categories = [];
    public $heroProd, $featuredProdList, $banners = [];
    public $featuredCat = 'all', $activeFilter = 'all', $firstCall = 1;
    public $latesProducts = [];
    public $viewedProducts = [];
    public $mostSharedProducts = [];
    public $randomProducts = [];

    public function mount()
    {
        $this->getHeroSection();
        $this->featuredProd();
        $this->getBanners();
        $this->getLatestProducts();
        $this->getMostSharedProducts();
        $this->getMostViewedProducts();
        $this->getRandomProduct();
    }

    public function getRandomProduct()
    {
        $this->randomProducts =
            DB::table('products as p')
            ->join('product_photos as pp', 'p.id', '=', 'pp.product_id')
            ->join('detail_products as dp', 'p.id', '=', 'dp.product_id')
            ->select('p.id', 'p.slug', 'p.name', 'p.price', 'pp.photo', 'p.created_at', 'dp.after_sale')
            ->where('pp.is_primary', 1)
            ->where('p.publish', '!=', 0)
            ->groupBy('p.id', 'p.slug', 'p.name', 'p.price', 'pp.photo', 'p.created_at', 'dp.after_sale')
            ->inRandomOrder()
            ->limit(6)
            ->get();
    }

    public function getHeroSection()
    {
        $this->categories = DB::table('categories')
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->select(
                'categories.id',
                'categories.name',
                'categories.slug',
                'categories.image',
                'categories.status',
                'categories.created_at',
                'categories.updated_at',
                DB::raw('COUNT(products.category_id) as prod_count')
            )
            ->groupBy('categories.id', 'categories.name', 'categories.slug', 'categories.image', 'categories.status', 'categories.created_at', 'categories.updated_at')
            ->orderByDesc('prod_count')
            ->get();
        $this->heroProd = DB::table('products as p')
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->join('product_photos as pp', 'p.id', '=', 'pp.product_id')
            ->select('p.id', 'p.name', 'p.short_desc', 'p.price', 'p.slug', 'pp.photo', 'c.name as category')
            ->where('p.is_hero', 1)
            ->where('p.publish', '!=', 0)
            ->where('pp.is_primary', 1)
            ->first();
    }

    public function updateFeaturedCat($categorySlug)
    {
        $this->featuredCat = $categorySlug;
        $this->activeFilter = $categorySlug;
        $this->firstCall = 2;
        $this->featuredProd();
    }
    public function featuredProd()
    {
        $this->featuredProdList = DB::table('products as p')
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->join('product_photos as pp', 'p.id', '=', 'pp.product_id')
            ->join('detail_products as dp', 'p.id', '=', 'dp.product_id')
            ->select(
                'p.id',
                'p.name',
                'p.short_desc',
                'p.price',
                'p.slug',
                'pp.photo',
                'c.name as category',
                'c.slug as slugCat',
                DB::raw('MAX(dp.seeing_count) as max_seeing_count'),
                'dp.share_count',
                'dp.after_sale',
            )
            ->where('pp.is_primary', 1)
            ->where('p.publish', '!=', 0)
            ->when($this->featuredCat != 'all', function ($query) {
                $query->where('c.slug', $this->featuredCat);
            })
            ->groupBy(
                'p.id',
                'p.name',
                'p.short_desc',
                'p.price',
                'p.slug',
                'pp.photo',
                'category',
                'dp.share_count',
                'slugCat',
                'dp.after_sale',
            )
            ->orderByDesc('max_seeing_count')
            ->get();
    }

    public function getBanners()
    {
        $this->banners = DB::table('banners')
            ->select('id', 'banner_img', 'is_see', 'url')
            ->where('is_see', 1)
            ->get();
    }

    public function getLatestProducts()
    {
        $this->latesProducts = DB::table('products as p')
            ->join('product_photos as pp', 'p.id', '=', 'pp.product_id')
            ->join('detail_products as dp', 'p.id', '=', 'dp.product_id')
            ->select('p.id', 'p.slug', 'p.name', 'p.price', 'pp.photo', 'p.created_at', 'dp.after_sale')
            ->where('pp.is_primary', 1)
            ->where('p.publish', '!=', 0)
            ->orderByDesc('p.created_at')
            ->groupBy('p.id', 'p.slug', 'p.name', 'p.price', 'pp.photo', 'p.created_at', 'dp.after_sale')
            ->havingRaw('COUNT(p.id) <= 6')
            ->get();
    }

    public function getMostSharedProducts()
    {
        $this->mostSharedProducts = DB::table('products as p')
            ->join('product_photos as pp', 'p.id', '=', 'pp.product_id')
            ->join('detail_products as dp', 'p.id', '=', 'dp.product_id')
            ->select('p.id', 'p.slug', 'p.name', 'p.price', 'pp.photo', 'p.created_at', 'dp.after_sale')
            ->where('pp.is_primary', 1)
            ->where('p.publish', '!=', 0)
            ->groupBy('p.id', 'p.slug', 'p.name', 'p.price', 'pp.photo', 'p.created_at', 'dp.share_count', 'dp.after_sale')
            ->orderByDesc('dp.share_count', 'dp.id')
            ->havingRaw('COUNT(p.id) <= 6')
            ->get();
    }

    public function getMostViewedProducts()
    {
        $this->viewedProducts = DB::table('products as p')
            ->join('product_photos as pp', 'p.id', '=', 'pp.product_id')
            ->join('detail_products as dp', 'p.id', '=', 'dp.product_id')
            ->select('p.id', 'p.slug', 'p.name', 'p.price', 'pp.photo', 'p.created_at', 'dp.after_sale')
            ->where('pp.is_primary', 1)
            ->where('p.publish', '!=', 0)
            ->groupBy('p.id', 'p.slug', 'p.name', 'p.price', 'pp.photo', 'p.created_at', 'dp.seeing_count', 'dp.after_sale')
            ->orderByDesc('dp.seeing_count', 'dp.id')
            ->havingRaw('COUNT(p.id) <= 6')
            ->get();
    }

    #[Layout('layouts.guest.main')]
    public function render()
    {
        return view('pages.guest.dashboard.dashboard');
    }
}
