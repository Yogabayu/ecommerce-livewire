<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class SearchComponentInline extends Component
{
    use WithPagination;
    #[Url]
    public $category = '', $inputText = '', $tag = '', $lowPrice = '', $highPrice = '';
    // public $inputText = '';
    private $results = [];
    public $state = 0;
    public $relatedProducts = [];
    public $countProduct = [];
    public $categories = [];
    public $populartags = [];
    public $latesProducts = [];
    // public $lowPrice, $highPrice;
    public $nameCat = '';


    public function updateSortState($value)
    {
        $this->search($value);
    }

    public function updateText($text)
    {
        $this->inputText = $text;
        $this->search($this->state);
    }
    public function updateTag($text)
    {
        $this->tag = $text;
        $this->search($this->state);
    }
    public function updateCategory($text)
    {
        $this->category = $text;
        $this->search($this->state);
    }

    public function clearFilter($id = 0)
    {
        if ($id == 1) {
            $this->category = '';
        }

        if ($id == 2) {
            $this->tag = '';
        }
        if ($id == 3) {
            $this->lowPrice = '';
            $this->highPrice = '';
        }

        $this->inputText = '';
        $this->search($this->state);
    }

    public function search($value)
    {
        // $query = DB::table('products as p')
        //     ->join('detail_products as dp', 'p.id', '=', 'dp.product_id')
        //     ->join('product_photos as pp', 'p.id', '=', 'pp.product_id')
        //     ->join('product_tag_mappings as ptm', 'p.id', '=', 'ptm.product_id')
        //     ->leftJoin('auction_schedules as ac', 'p.id', '=', 'ac.product_id')
        //     ->join('categories as c', 'c.id', '=', 'p.category_id')
        //     ->join('tags as t', 'ptm.tag_id', '=', 't.id')
        //     ->select(
        //         'p.id',
        //         'p.name',
        //         'p.slug',
        //         'p.price',
        //         'dp.after_sale',
        //         'dp.seeing_count',
        //         'dp.share_count',
        //         'c.name as nameCategory',
        //         'pp.photo'
        //     )
        //     ->where('pp.is_primary', 1)
        //     ->where('p.publish', '!=', 0);

        // if ($this->category && $this->tag == '' && $this->inputText == '') {
        //     $category = $this->category;
        //     // $query->where(function ($query) use ($category) {
        //     //     $query->where('c.name', 'LIKE', '%' . $category . '%')
        //     //         ->orWhere('c.slug', 'LIKE', '%' . $category . '%');
        //     // });
        //     $idCategory = DB::table('categories')->where('name', 'LIKE', '%' . $category . '%')->first();
        //     $query->where('c.id', $idCategory->id);
        // } elseif ($this->tag && $this->category == '' && $this->inputText == '') {
        //     $tag = $this->tag;
        //     $query->where(function ($query) use ($tag) {
        //         $query->where('t.name', $tag);
        //     });
        // } elseif ($this->lowPrice || $this->highPrice) {
        //     $low = str_replace(".", "", $this->lowPrice);
        //     $high = str_replace(".", "", $this->highPrice);

        //     $query->where(function ($query) use ($low, $high) {
        //         if (
        //             $low != null
        //         ) {
        //             $query->whereRaw('CAST(REPLACE(p.price, ".", "") AS UNSIGNED) >= ?', [(int)$low]);
        //         }

        //         if ($high != null) {
        //             $query->whereRaw('CAST(REPLACE(p.price, ".", "") AS UNSIGNED) <= ?', [(int)$high]);
        //         }
        //     });
        // } elseif ($this->inputText) {
        //     $inputTextWithoutSpaces = str_replace(' ', '', $this->inputText);
        //     $slug = str_replace(' ', '-', $this->inputText);
        //     $inputText = $this->inputText;

        //     $query->where(function ($query) use ($inputTextWithoutSpaces, $slug, $inputText) {
        //         $query->where('p.name', 'LIKE', '%' . $inputText . '%')
        //             ->orWhere('p.short_desc', 'LIKE', '%' . $inputText . '%')
        //             ->orWhere('dp.long_desc', 'LIKE', '%' . $inputText . '%')
        //             ->orWhere('dp.address', 'LIKE', '%' . $inputText . '%')
        //             ->orWhere('c.name', 'LIKE', '%' . $inputText . '%')
        //             ->orWhere('p.slug', 'LIKE', '%' . $slug . '%')
        //             ->orWhere('c.slug', 'LIKE', '%' . $slug . '%')
        //             ->orWhere('t.name', 'LIKE', '%' . $inputText . '%')
        //             ->orWhere('ac.kpknl', 'LIKE', '%' . $inputText . '%')
        //             ->orWhere('p.price', 'LIKE', '%' . $inputText . '%')
        //             ->orWhere(DB::raw("REPLACE(p.name, ' ', '')"), 'LIKE', '%' . $inputTextWithoutSpaces . '%')
        //             ->orWhere(DB::raw("REPLACE(p.short_desc, ' ', '')"), 'LIKE', '%' . $inputTextWithoutSpaces . '%')
        //             ->orWhere(DB::raw("REPLACE(dp.long_desc, ' ', '')"), 'LIKE', '%' . $inputTextWithoutSpaces . '%')
        //             ->orWhere(DB::raw("REPLACE(c.name, ' ', '')"), 'LIKE', '%' . $inputTextWithoutSpaces . '%');
        //     });
        // }

        // if ($value == 1) { // Terbaru
        //     $query->orderBy('p.created_at', 'DESC');
        // } elseif ($value == 2) { // Terlama
        //     $query->orderBy('p.created_at', 'ASC');
        // } elseif ($value == 3) { // A-Z
        //     $query->orderBy('p.name', 'ASC');
        // } elseif ($value == 4) { // Z-A
        //     $query->orderBy('p.name', 'DESC');
        // } elseif ($value == 5) { // Termahal
        //     // $query->orderBy(DB::raw('CAST(REPLACE(p.price, ".", "") AS SIGNED)'), 'DESC');
        //     $query->orderBy(DB::raw('
        //         CASE
        //             WHEN dp.after_sale IS NOT NULL THEN CAST(REPLACE(dp.after_sale, ".", "") AS SIGNED)
        //             ELSE CAST(REPLACE(p.price, ".", "") AS SIGNED)
        //         END
        //     '), 'DESC');
        // } elseif ($value == 6) { // Termurah
        //     // $query->orderBy(DB::raw('CAST(REPLACE(p.price, ".", "") AS SIGNED)'), 'ASC');
        //     $query->orderBy(DB::raw('
        //         CASE
        //             WHEN dp.after_sale IS NOT NULL THEN CAST(REPLACE(dp.after_sale, ".", "") AS SIGNED)
        //             ELSE CAST(REPLACE(p.price, ".", "") AS SIGNED)
        //         END
        //     '), 'ASC');
        // }

        // $this->results = $query->groupBy(
        //     'c.name',
        //     'p.id',
        //     'p.name',
        //     'p.slug',
        //     'p.short_desc',
        //     'p.price',
        //     'dp.after_sale',
        //     'dp.seeing_count',
        //     'dp.share_count',
        //     'pp.photo'
        // )->simplePaginate(10);

        // $this->countProduct = $query->count();

        $query = DB::table('products as p')
            ->join('detail_products as dp', 'p.id', '=', 'dp.product_id')
            ->join('product_photos as pp', 'p.id', '=', 'pp.product_id')
            ->join('product_tag_mappings as ptm', 'p.id', '=', 'ptm.product_id')
            ->leftJoin('auction_schedules as ac', 'p.id', '=', 'ac.product_id')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->join('tags as t', 'ptm.tag_id', '=', 't.id')
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
            ->where('pp.is_primary', 1)
            ->where('p.publish', '!=', 0);

        if ($this->category && $this->tag == '' && $this->inputText == '') {
            $category = $this->category;
            // $query->where(function ($query) use ($category) {
            //     $query->where('c.name', 'LIKE', '%' . $category . '%')
            //         ->orWhere('c.slug', 'LIKE', '%' . $category . '%');
            // });
            // $idCategory = DB::table('categories')->where('name', 'LIKE', '%' . $category . '%')->first();
            $nameCat = DB::table('categories')->where('id', $category)->first();
            $nameCat = $nameCat->name;
            $query->where('c.id', $category);
        } elseif ($this->tag && $this->category == '' && $this->inputText == '') {
            $tag = $this->tag;
            $query->where(function ($query) use ($tag) {
                $query->where('t.name', $tag);
            });
        } elseif ($this->lowPrice || $this->highPrice) {
            $low = str_replace(".", "", $this->lowPrice);
            $high = str_replace(".", "", $this->highPrice);

            $query->where(function ($query) use ($low, $high) {
                if ($low != null) {
                    $query->whereRaw('CAST(REPLACE(p.price, ".", "") AS UNSIGNED) >= ?', [(int)$low]);
                }

                if ($high != null) {
                    $query->whereRaw('CAST(REPLACE(p.price, ".", "") AS UNSIGNED) <= ?', [(int)$high]);
                }
            });
        } elseif ($this->inputText) {
            $inputTextWithoutSpaces = str_replace(' ', '', $this->inputText);
            $slug = str_replace(' ', '-', $this->inputText);
            $inputText = $this->inputText;

            $query->where(function ($query) use ($inputTextWithoutSpaces, $slug, $inputText) {
                $query->where('p.name', 'LIKE', '%' . $inputText . '%')
                    ->orWhere('p.short_desc', 'LIKE', '%' . $inputText . '%')
                    ->orWhere('dp.long_desc', 'LIKE', '%' . $inputText . '%')
                    ->orWhere('dp.address', 'LIKE', '%' . $inputText . '%')
                    ->orWhere('c.name', 'LIKE', '%' . $inputText . '%')
                    ->orWhere('p.slug', 'LIKE', '%' . $slug . '%')
                    ->orWhere('c.slug', 'LIKE', '%' . $slug . '%')
                    ->orWhere(
                        't.name',
                        'LIKE',
                        '%' . $inputText . '%'
                    )
                    ->orWhere('ac.kpknl', 'LIKE', '%' . $inputText . '%')
                    ->orWhere('p.price', 'LIKE', '%' . $inputText . '%')
                    ->orWhere(DB::raw("REPLACE(p.name, ' ', '')"), 'LIKE', '%' . $inputTextWithoutSpaces . '%')
                    ->orWhere(DB::raw("REPLACE(p.short_desc, ' ', '')"), 'LIKE', '%' . $inputTextWithoutSpaces . '%')
                    ->orWhere(DB::raw("REPLACE(dp.long_desc, ' ', '')"), 'LIKE', '%' . $inputTextWithoutSpaces . '%')
                    ->orWhere(DB::raw("REPLACE(c.name, ' ', '')"), 'LIKE', '%' . $inputTextWithoutSpaces . '%');
            });
        }

        if ($value == 1) { // Terbaru
            $query->orderBy('p.created_at', 'DESC');
        } elseif ($value == 2) { // Terlama
            $query->orderBy('p.created_at', 'ASC');
        } elseif ($value == 3) { // A-Z
            $query->orderBy('p.name', 'ASC');
        } elseif ($value == 4) { // Z-A
            $query->orderBy('p.name', 'DESC');
        } elseif ($value == 5) { // Termahal
            $query->orderBy(DB::raw('
        CASE
            WHEN dp.after_sale IS NOT NULL THEN CAST(REPLACE(dp.after_sale, ".", "") AS SIGNED)
            ELSE CAST(REPLACE(p.price, ".", "") AS SIGNED)
        END
    '), 'DESC');
        } elseif ($value == 6) { // Termurah
            $query->orderBy(DB::raw('
        CASE
            WHEN dp.after_sale IS NOT NULL THEN CAST(REPLACE(dp.after_sale, ".", "") AS SIGNED)
            ELSE CAST(REPLACE(p.price, ".", "") AS SIGNED)
        END
    '), 'ASC');
        }

        $this->results = $query->simplePaginate(20);

        $this->countProduct = $query->distinct()->count();

        $this->state = $value;
    }

    public function getRelatedProduct()
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
            ->where('pp.is_primary', 1)
            ->where('p.publish', '!=', 0);

        $this->relatedProducts = $query
            ->groupBy(
                'p.id',
                'p.name',
                'p.slug',
                'p.price',
                'dp.after_sale',
                'dp.seeing_count',
                'dp.share_count',
                'c.name',
                'pp.photo'
            )
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }
    public function getLatestProducts()
    {
        $this->latesProducts = DB::table('products as p')
            ->join('product_photos as pp', 'p.id', '=', 'pp.product_id')
            ->select('p.id', 'p.slug', 'p.name', 'p.price', 'pp.photo', 'p.created_at')
            ->where('pp.is_primary', 1)
            ->where('p.publish', '!=', 0)
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
    public function mount()
    {
        $this->search($this->state);
        $this->getRelatedProduct();
        $this->getLatestProducts();
        $this->getPopularTag();
        $this->getCategories();
    }

    #[Layout('layouts.guest.main')]
    public function render()
    {
        $this->search($this->state);
        // dd($this->inputText);
        // dd($this->category);
        return view('pages.guest.search.index', ['results' => $this->results]);
    }
}
