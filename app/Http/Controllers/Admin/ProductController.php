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
    public function changePhotoPrimary($id)
    {
        try {
            $photo = ProductPhoto::find($id);

            if ($photo) {
                // Set is_primary to 1 for the specified photo
                $photo->is_primary = 1;
                $photo->save();

                // Set is_primary to 0 for other photos associated with the same product
                ProductPhoto::where('product_id', $photo->product_id)
                    ->where('id', '!=', $id)
                    ->update(['is_primary' => 0]);

                return redirect()->back()->with('success', 'Primary photo changed successfully.');
            }

            return redirect()->back()->with('error', 'Photo not found.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to change primary photo.');
        }
    }

    public function deletePhotos($id)
    {
        try {
            $photo = ProductPhoto::find($id);

            if ($photo) {
                $countPhotos = ProductPhoto::where('product_id', $photo->product_id)->count();

                if ($countPhotos > 1) {
                    $isPrimary = $photo->is_primary;

                    Storage::delete("public/photos/{$photo->photo}");
                    $photo->delete();

                    if ($isPrimary) {
                        // Find another photo and set it as primary
                        $newPrimaryPhoto = ProductPhoto::where('product_id', $photo->product_id)->first();
                        $newPrimaryPhoto->is_primary = 1;
                        $newPrimaryPhoto->save();
                    }

                    return redirect()->back()->with('success', 'Photo deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Cannot delete the only remaining photo.');
                }
            }

            return redirect()->back()->with('error', 'Gagal menghapus photo');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus photo');
        }
    }


    public function addPhotos(Request $request)
    {
        try {
            $request->validate([
                'id'            => 'required|exists:products,id',
                'photos'        => 'required|array', // Ensure 'photos' is an array
                'photos.*'      => 'image|mimes:jpeg,jpg,png|max:2048', // Validate each photo in the array
            ]);

            $photoFiles = $request->file('photos');
            $isPrimarySet = DB::table('product_photos')
                ->where('product_id', $request->id)
                ->where('is_primary', 1)
                ->exists();

            foreach ($photoFiles as $photoFile) {
                $extension = $photoFile->extension();
                $imgname = date('dmyHis') . uniqid() . '.' . $extension;
                $path = Storage::putFileAs('public/photos', $photoFile, $imgname);

                // Insert into 'product_photos' table
                $productPhotos = new ProductPhoto;
                $productPhotos->product_id = $request->id;
                $productPhotos->photo = $imgname;

                // Set the first photo as primary
                if (!$isPrimarySet) {
                    $productPhotos->is_primary = 1;
                    $isPrimarySet = true; // Set the flag after setting is_primary for the first photo
                } else {
                    $productPhotos->is_primary = 0;
                }

                $productPhotos->save();
            }

            return redirect()->back()->with('success', 'Berhasil menambahkan photo');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan upload foto');
        }
    }

    public function changeVisibility($id)
    {
        try {
            $product = Product::where('id', $id)->first();
            $product->publish = $product->publish == 1 ? 0 : 1;
            $product->save();

            return redirect()->back()->with('success', 'Product changed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'gagal melakukan perubahan');
        }
    }
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
            $fileSup = '';
            if ($request->hasFile('sup_doc')) {
                // Handle image upload
                $extension = $request->file('sup_doc')->extension();
                $fileSup = date('dmyHis') . uniqid() . '.' . $extension;
                $path = Storage::putFileAs('public/sup_doc', $request->file('sup_doc'), $fileSup);
            }

            DetailProduct::create([
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
                'sup_doc'           => $fileSup,
            ]);

            // Handle product photos upload
            $photoFiles = $request->file('photos');
            $isPrimarySet = 0;

            foreach ($photoFiles as $photoFile) {
                $extension = $photoFile->extension();
                $imgname = date('dmyHis') . uniqid() . '.' . $extension;
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
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = DB::table('products')
                ->where('products.id', $id)
                ->first();
            // dd($product);

            $detailProduct = DB::table('detail_products')
                ->join('indonesia_provinces', 'indonesia_provinces.code', '=', 'detail_products.province_code')
                ->join('indonesia_cities', 'indonesia_cities.code', '=', 'detail_products.city_code')
                ->select(
                    'detail_products.*',
                    'indonesia_provinces.name as name_province',
                    'indonesia_cities.name as name_city'
                )
                ->where('detail_products.product_id', $id)
                ->first();
            $productPhotos = DB::table('product_photos')->where('product_id', $id)->select('product_photos.*')->get();
            $productTags = DB::table('product_tag_mappings')
                ->join('tags', 'tags.id', '=', 'product_tag_mappings.tag_id')
                ->select(
                    'tags.id',
                    'tags.name',
                )
                ->where('product_id', $id)
                ->get();

            //additional
            $categories = DB::table('categories')->where('status', '!=', 0)->select('id', 'name')->get();


            return view('pages.admin.product.components.show', compact('product', 'detailProduct', 'productPhotos', 'productTags', 'categories',));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $product = DB::table('products')
                ->where('products.id', $id)
                ->first();
            // dd($product);

            $detailProduct = DB::table('detail_products')
                ->join('indonesia_provinces', 'indonesia_provinces.code', '=', 'detail_products.province_code')
                ->join('indonesia_cities', 'indonesia_cities.code', '=', 'detail_products.city_code')
                ->select(
                    'detail_products.*',
                    'indonesia_provinces.name as name_province',
                    'indonesia_cities.name as name_city'
                )
                ->where('detail_products.product_id', $id)
                ->first();
            $productPhotos = DB::table('product_photos')->where('product_id', $id)->select('product_photos.*')->get();
            $productTags = DB::table('product_tag_mappings')
                ->join('tags', 'tags.id', '=', 'product_tag_mappings.tag_id')
                ->select(
                    'tags.id'
                )
                ->where('product_id', $id)
                ->get()
                ->pluck('id')
                ->toArray();
            // dd($productTags);

            //additional
            $categories = DB::table('categories')->where('status', '!=', 0)->select('id', 'name')->get();
            $provinces = DB::table('indonesia_provinces')->get();
            $tags = DB::table('tags')->get();


            return view('pages.admin.product.components.edit', compact('product', 'detailProduct', 'productPhotos', 'productTags', 'categories', 'provinces', 'tags'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            ]);
            //slug
            $slugProduct = Str::slug($request->name);

            //insert to table product
            $product = Product::findOrFail($id)->update([
                'user_uuid'     => auth()->user()->uuid,
                'category_id'   => $request->category_id,
                'name'          => $request->name,
                'short_desc'    => $request->short_desc,
                'price'         => $request->price,
                'publish'       => $request->publish,
                'slug'          => $slugProduct,
            ]);

            $dp                     = DetailProduct::where('product_id', $id)->first();
            $dp->product_id         = $id;
            $dp->province_code      = $request->province_code;
            $dp->city_code          = $request->city_code;
            $dp->address            = $request->address;
            $dp->long_desc          = $request->long_desc;
            $dp->lat                = $request->lat;
            $dp->long               = $request->long;
            $dp->gmaps              = $request->gmaps;
            $dp->surface_area       = $request->surface_area;
            $dp->building_area      = $request->building_area;

            if ($request->hasFile('sup_doc')) {
                // Handle image upload
                $extension = $request->file('sup_doc')->extension();
                $fileSup = date('dmyHis') . '.' . $extension;
                $path = Storage::putFileAs('public/sup_doc', $request->file('sup_doc'), $fileSup);
                if ($dp->sup_doc) {
                    Storage::delete("public/photos/{$dp->sup_doc}");
                }
                $dp->sup_doc        = $fileSup;
            }
            $dp->type_sales         = $request->type_sales;
            $dp->no_pic             = $request->no_pic;
            $dp->save();

            //handle tag product
            $tagsProduct = $request->tags;
            $existingTagIds = ProductTagMapping::where('product_id', $id)->pluck('tag_id')->toArray();
            foreach ($tagsProduct as $tp) {
                if (!in_array($tp, $existingTagIds)) {
                    $tagMapping = new ProductTagMapping;
                    $tagMapping->product_id = $id;
                    $tagMapping->tag_id = $tp;
                    $tagMapping->save();
                }
            }
            return redirect()->back()->with('success', 'Product updated successfully!');
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
            DB::table('product_tag_mappings')->where('product_id', $id)->delete();
            $delPhotos = DB::table('product_photos')->where('product_id', $id)->get();
            foreach ($delPhotos as $dp) {
                if ($dp->photo) {
                    Storage::delete("public/photos/{$dp->photo}");
                }
                DB::table('product_photos')->where('id', $dp->id)->delete();
            };
            DB::table('detail_products')->where('product_id', $id)->delete();
            DB::table('products')->where('id', $id)->delete();

            return redirect()->back()->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
