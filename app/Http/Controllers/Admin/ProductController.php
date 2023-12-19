<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\DetailProduct;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\ProductTagMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function getCities($provinceCode)
    {
        $cities = DB::table('indonesia_cities')->where('province_code', $provinceCode)->get();
        return response()->json($cities);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            //get data from product table and join it with detail_product and product_photos
            // $products = DB::table('products')
            //     ->join('detail_products', 'products.id', '=', 'detail_products.product_id')
            //     ->join('product_photos', 'products.id', '=', 'product_photos.product_id')
            //     ->join('indonesia_provinces', 'detail_products.province_code', '=', 'indonesia_provinces.code')
            //     ->join('indonesia_cities', 'indonesia_provinces.code', '=', 'indonesia_cities.province_code')
            //     ->select('products.*', 'detail_products.*', 'indonesia_provinces.name as name-province', 'indonesia_cities.name as name-city', 'product_photos.*')
            //     ->get();
            $products = Product::with('category')->get();

            return view('pages.admin.product.index', compact('products'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categories = DB::table('categories')->where('status', '!=', 0)->select('id', 'name')->get();
            $provinces = DB::table('indonesia_provinces')->get();
            $tags = DB::table('tags')->get();

            return view('pages.admin.product.components.insert', compact('categories', 'provinces', 'tags'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'category_id'   => 'required',
                'name'          => 'required|string',
                'short_desc'    => 'required|string',
                'price'         => 'required',
                'publish'       => 'required|boolean',

                'province_code' => 'required|string',
                'city_code'     => 'required|string',
                'address'          => 'required|string',
                'long_desc'     => 'required|string',
                'type_sales'    => 'required|string',
                'no_pic'        => 'required',

                'tags'        => 'required|array', // Ensure 'photos' is an array
                'photos'        => 'required|array', // Ensure 'photos' is an array
                'photos.*'      => 'image|mimes:jpeg,jpg,png|max:2048', // Validate each photo in the array
            ]);
            //slug
            $slugProduct = Str::slug($request->name);

            //insert to table product
            $product = Product::create([
                'user_uuid'     => auth()->user()->uuid,
                'category_id'   => $request->category_id,
                'name'          => $request->name,
                'short_desc'    => $request->short_desc,
                'price'         => $request->price,
                'publish'       => $request->publish,
                'slug'          => $slugProduct,
            ]);

            //insert to table detail_product
            $detailProduct = DetailProduct::create([
                'product_id'        => $product->id,
                'province_code'     => $request->province_code,
                'city_code'         => $request->city_code,
                'address'           => $request->address,
                'long_desc'         => $request->long_desc,
                'lat'               => $request->lat,
                'long'              => $request->long,
                'gmaps'             => $request->gmaps,
                'surface_area'      => $request->surface_area,
                'building_area'     => $request->building_area,
                'type_sales'        => $request->type_sales,
                'no_pic'            => $request->no_pic,
            ]);

            if ($request->hasFile('sup_doc')) {
                // Handle image upload
                $extension = $request->file('sup_doc')->extension();
                $imgname = date('dmyHis') . '.' . $extension;
                $path = Storage::putFileAs('public/sup_doc', $request->file('sup_doc'), $imgname);

                DetailProduct::findOrFail($detailProduct->id)->update(['sup_doc' => $imgname]);
            }

            // Handle product photos upload
            $photoFiles = $request->file('photos');
            $isPrimarySet = 0;

            foreach ($photoFiles as $photoFile) {
                $extension = $photoFile->extension();
                $imgname = date('dmyHis') . '.' . $extension;
                $path = Storage::putFileAs('public/photos', $photoFile, $imgname);

                // Insert into 'product_photos' table
                $productPhotos = new ProductPhoto;
                $productPhotos->product_id = $product->id;
                $productPhotos->photo = $imgname;

                // Set the first photo as primary
                if (!$isPrimarySet) {
                    $productPhotos->is_primary = 1;
                    $isPrimarySet = true;
                } else {
                    $productPhotos->is_primary = 0;
                }

                $productPhotos->save();
            }

            //handle tag product
            $tagsProduct = $request->tags;
            foreach ($tagsProduct as $tp) {
                $tagMapping = new ProductTagMapping;
                $tagMapping->product_id = $product->id;
                $tagMapping->tag_id = $tp;
                $tagMapping->save();
            }

            return redirect()->back()->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            // return redirect()->back()->with("error", $e->getMessage());
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            //code...
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            //code...
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
