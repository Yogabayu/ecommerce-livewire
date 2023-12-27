<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ShopComponent extends Component
{
    public $categories = [], $saleProducts = [], $populartags = [], $latesProducts = [];
    public $selecsort = 0;

    public function updatedSelecsort($value)
    {
        dd('masuk sini');
    }

    public function getProduct($sort)
    {
        $query = DB::table('products as p')
            ->join('detail_products as dp', 'p.id', '=', 'dp.product_id')
            ->join('product_photos as pp', 'p.id', '=', 'pp.product_id')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->select(
                'p.id',
                'p.name',
                'p.slug',
                'p.price',
                'dp.after_sale',
                'dp.seeing_count',
                'dp.share_count',
                'c.name as nameCategory',
                'pp.photo'
            )
            ->where('pp.is_primary', 1);

        if ($sort == 1) {
            $query->orderByDesc('p.created_at');
        } elseif ($sort == 2) {
            $query->orderBy('p.created_at', 'ASC');
        }

        $this->saleProducts = $query->groupBy(
            'p.id',
            'p.name',
            'p.slug',
            'p.price',
            'dp.after_sale',
            'dp.seeing_count',
            'dp.share_count',
            'c.name',
            'pp.photo'
        )->get();
    }


    public function getLatestProducts()
    {
        $this->latesProducts = DB::table('products as p')
            ->join('product_photos as pp', 'p.id', '=', 'pp.product_id')
            ->select('p.id', 'p.slug', 'p.name', 'p.price', 'pp.photo', 'p.created_at')
            ->where('pp.is_primary', 1)
            ->orderByDesc('p.created_at')
            ->groupBy('p.id', 'p.slug', 'p.name', 'p.price', 'pp.photo', 'p.created_at')
            ->havingRaw('COUNT(p.id) <= 6')
            ->get();
    }

    public function getPopularTag()
    {
        $this->populartags = DB::table('products as p')
            ->join('product_tag_mappings as ptm', 'p.id', '=', 'ptm.product_id')
            ->join('tags as t', 'ptm.tag_id', '=', 't.id')
            ->select('t.name', DB::raw('COUNT(p.id) as prod_count'))
            ->groupBy('t.name')
            ->orderByDesc('prod_count')
            ->get();
    }

    public function getCategories()
    {
        $this->categories = DB::table('categories')
            ->select('id', 'name', 'slug', 'image')
            ->where('status', '!=', 0)
            ->get();
    }

    public function getSale()
    {
        $this->saleProducts = DB::table('products as p')
            ->join('detail_products as dp', 'p.id', '=', 'dp.product_id')
            ->join('product_photos as pp', 'p.id', '=', 'pp.product_id')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->select('p.id', 'p.name', 'p.slug', 'p.price', 'dp.after_sale', 'dp.seeing_count', 'dp.share_count', 'c.name as nameCategory', 'pp.photo')
            ->where('pp.is_primary', 1)
            ->havingRaw('COUNT(p.id) <= 6')
            ->orderByDesc('dp.after_sale')
            ->groupBy('p.id', 'p.name', 'p.slug', 'p.price', 'dp.after_sale', 'dp.seeing_count', 'dp.share_count', 'c.name', 'pp.photo')
            ->get();
    }

    public function mount()
    {
        $this->getCategories();
        $this->getSale();
        $this->getPopularTag();
        $this->getLatestProducts();
        $this->getProduct($this->selecsort);
    }

    #[Layout('layouts.guest.main')]
    public function render()
    {
        return view('pages.guest.shop.index');
    }
}
