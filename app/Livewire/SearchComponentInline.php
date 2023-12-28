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
    public $inputText = '';
    private $results = [];
    public $state = 0;
    public $relatedProducts = [];

    public function updateSortState($value)
    {
        $this->search($value);
    }

    public function search($value)
    {
        $inputTextWithoutSpaces = str_replace(' ', '', $this->inputText);

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
            ->where(function ($query) use ($inputTextWithoutSpaces) {
                $query->where('p.name', 'LIKE', '%' . $this->inputText . '%')
                    ->orWhere('p.short_desc', 'LIKE', '%' . $this->inputText . '%')
                    ->orWhere('dp.long_desc', 'LIKE', '%' . $this->inputText . '%')
                    ->orWhere('c.name', 'LIKE', '%' . $this->inputText . '%')
                    ->orWhere(DB::raw("REPLACE(p.name, ' ', '')"), 'LIKE', '%' . $inputTextWithoutSpaces . '%')
                    ->orWhere(DB::raw("REPLACE(p.short_desc, ' ', '')"), 'LIKE', '%' . $inputTextWithoutSpaces . '%')
                    ->orWhere(DB::raw("REPLACE(dp.long_desc, ' ', '')"), 'LIKE', '%' . $inputTextWithoutSpaces . '%')
                    ->orWhere(DB::raw("REPLACE(c.name, ' ', '')"), 'LIKE', '%' . $inputTextWithoutSpaces . '%');
            });
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

        $this->results = $query->groupBy(
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
            ->where('pp.is_primary', 1);

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
            ->limit(8)
            ->get();
    }

    public function mount()
    {
        $this->search($this->state);
        $this->getRelatedProduct();
    }

    #[Layout('layouts.guest.main')]
    public function render()
    {
        $this->search($this->state);
        return view('pages.guest.search.index', ['results' => $this->results]);
    }
}
