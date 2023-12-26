<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;

class DetailProductComponent extends Component
{
    #[Url]
    public $slug;
    public $generalProduct;
    public $idProduct;
    public $photoProducts = [];

    public function getGeneralProduct()
    {
        $this->generalProduct = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as nameCategory', 'categories.slug as slugCategory',)
            ->where('products.slug', $this->slug)
            ->first();
    }

    public function getIdProduct()
    {
        $this->idProduct = $this->generalProduct->id;
    }

    public function getPhotoProducts()
    {
        $this->photoProducts = DB::table('product_photos')->where('product_id', $this->idProduct)->get();
    }

    public function mount()
    {
        $this->getGeneralProduct();
        $this->getIdProduct();
        $this->getPhotoProducts();
    }

    #[Layout('layouts.guest.main')]
    public function render()
    {
        return view('pages.guest.detailproduct.index');
    }
}
