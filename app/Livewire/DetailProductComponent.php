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
    public $detailProduct = [];
    public $viewCount = 0;
    public $relatedProducts = [];
    public $tagProducts = [];

    public function getHashtag()
    {
        $this->tagProducts = DB::table('products')
            ->join('product_tag_mappings', 'products.id', '=', 'product_tag_mappings.product_id')
            ->join('tags', 'product_tag_mappings.tag_id', '=', 'tags.id')
            ->select('tags.name')
            ->distinct()
            ->get();
    }

    public function getRelatedProducts()
    {
        $idProduct = $this->idProduct;
        $this->relatedProducts = DB::table('products')
            ->join('product_photos', 'products.id', '=', 'product_photos.product_id')
            ->join('detail_products', 'products.id', '=', 'detail_products.product_id')
            ->join('product_tag_mappings', 'products.id', '=', 'product_tag_mappings.product_id')
            ->whereIn('product_tag_mappings.tag_id', function ($query) {
                $query->select('tag_id')
                    ->from('product_tag_mappings')
                    ->where('product_id', '=', $this->idProduct);
            })
            ->where('products.id', '<>', $this->idProduct)
            ->where('product_photos.is_primary', 1)
            ->select('products.id', 'products.name', 'products.short_desc', 'products.slug', 'products.price', 'product_photos.photo', 'detail_products.seeing_count', 'detail_products.share_count', 'detail_products.after_sale')
            ->groupBy('products.id', 'products.name', 'products.short_desc', 'products.slug', 'products.price', 'product_photos.photo', 'detail_products.seeing_count', 'detail_products.share_count', 'detail_products.after_sale')
            ->get();
    }

    public function getGeneralProduct()
    {
        $this->generalProduct = DB::table('products')
            ->join('users', 'products.user_uuid', '=', 'users.uuid')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as nameCategory', 'categories.slug as slugCategory', 'users.name as username')
            ->where('products.slug', $this->slug)
            ->first();
    }

    public function getIdProduct()
    {
        $this->idProduct = $this->generalProduct->id;
    }

    public function getPhotoProducts()
    {
        $this->photoProducts = DB::table('product_photos')->where('product_id', $this->idProduct)->orderBy('id')->get();
    }

    public function getDetailProduct()
    {
        $this->detailProduct = DB::table('detail_products')
            ->join('indonesia_provinces', 'indonesia_provinces.code', '=', 'detail_products.province_code')
            ->join('indonesia_cities', 'indonesia_cities.code', '=', 'detail_products.city_code')
            ->select(
                'detail_products.*',
                'indonesia_provinces.name as name_province',
                'indonesia_cities.name as name_city'
            )
            ->where('detail_products.product_id', $this->idProduct)
            ->first();
        $this->viewCount = $this->detailProduct->seeing_count;
    }

    public function addView()
    {
        $this->viewCount++;
        DB::table('detail_products')->where('product_id', $this->idProduct)->update([
            'seeing_count' => $this->viewCount,
        ]);
    }

    public function addShareCount($id, $text)
    {
        $product = DB::table('detail_products')->where('product_id', $id)->first();
        DB::table('detail_products')->where('product_id', $id)->update([
            'share_count' => $product->share_count + 1
        ]);

        return redirect()->to($text);
    }

    public function mount()
    {
        $this->getGeneralProduct();
        $this->getIdProduct();
        $this->getPhotoProducts();
        $this->getDetailProduct();
        $this->getRelatedProducts();
        $this->getHashtag();

        $this->viewCount++;
        DB::table('detail_products')->where('product_id', $this->idProduct)->update([
            'seeing_count' => $this->viewCount,
        ]);
    }

    #[Layout('layouts.guest.main')]
    public function render()
    {
        return view('pages.guest.detailproduct.index');
    }
}
