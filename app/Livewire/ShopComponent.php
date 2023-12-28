<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;

    public $categories = [], $saleProducts = [], $populartags = [], $latesProducts = [];
    public $state = 0;
    public $countProduct;
    private $sortProducts = [];

    public function updateSortState($value)
    {
        $this->getProduct($value);
    }

    public function getProduct($value)
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

        $this->countProduct = $query->count();

        if ($value == 1) { // Terbaru
            $query->orderBy('p.created_at', 'DESC');
        } elseif ($value == 2) { // Terlama
            $query->orderBy('p.created_at', 'ASC');
        } elseif ($value == 3) { // A-Z
            $query->orderBy('p.name', 'ASC');
        } elseif ($value == 4) { // Z-A
            $query->orderBy('p.name', 'DESC');
        } elseif ($value == 5) { // Termahal
            $query->orderBy(DB::raw('CAST(REPLACE(p.price, ".", "") AS SIGNED)'), 'DESC');
        } elseif ($value == 6) { // Termurah
            $query->orderBy(DB::raw('CAST(REPLACE(p.price, ".", "") AS SIGNED)'), 'ASC');
        }

        $this->sortProducts = $query->groupBy(
            'p.id',
            'p.name',
            'p.slug',
            'p.price',
            'dp.after_sale',
            'dp.seeing_count',
            'dp.share_count',
            'c.name',
            'pp.photo'
        )->paginate(10);

        $this->state = $value;
    }

    public function getSaleProduct()
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

    public function boot()
    {
        $this->getCategories();
        $this->getSale();
        $this->getPopularTag();
        $this->getLatestProducts();
        $this->getSaleProduct();
    }

    public function mount()
    {
        $this->getProduct(0);
    }

    #[Layout('layouts.guest.main')]
    public function render()
    {
        $this->updateSortState($this->state);
        return view('pages.guest.shop.index', ['sortProducts' => $this->sortProducts]);
    }
}
