<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HeadComponent extends Component
{
    public $categories = [];

    public function getCategories()
    {
        $this->categories = DB::table('categories')
            ->join('products', function ($join) {
                $join->on('categories.id', '=', 'products.category_id')
                    ->where('products.publish', '=', 1);
            })
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
            ->where('categories.status', '!=', 0)
            ->groupBy('categories.id', 'categories.name', 'categories.slug', 'categories.image', 'categories.status', 'categories.created_at', 'categories.updated_at')
            ->orderByDesc('prod_count')
            ->get();
    }

    public function mount()
    {
        // $this->categories = DB::table('categories')
        //     ->join('products', function ($join) {
        //         $join->on('categories.id', '=', 'products.category_id')
        //             ->where('products.publish', '=', 1);
        //     })
        //     ->select(
        //         'categories.id',
        //         'categories.name',
        //         'categories.slug',
        //         'categories.image',
        //         'categories.status',
        //         'categories.created_at',
        //         'categories.updated_at',
        //         DB::raw('COUNT(products.category_id) as prod_count')
        //     )
        //     ->groupBy('categories.id', 'categories.name', 'categories.slug', 'categories.image', 'categories.status', 'categories.created_at', 'categories.updated_at')
        //     ->orderByDesc('prod_count')

        //     ->havingRaw('COUNT(categories.id) <= 11')
        //     ->get();

        $this->getCategories();
    }

    public function render()
    {
        return view('pages.guest.components.hero');
    }
}
