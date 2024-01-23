<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\AccessProductModel;
use App\Models\AuctionSchedule;
use App\Models\DetailProduct;
use App\Models\FacilitiesProduct;
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
    public function changeHero($slug)
    {
        try {
            $product = Product::where('slug', $slug)->first();

            if (!$product) {
                return redirect()->back()->with('error', 'Product not found!');
            }
            $currentHero = Product::where('is_hero', 1)->first();

            if ($product->publish != 1) {
                return redirect()->back()->with('error', 'Asset harus ditampilkan untuk menjadi hero');
            }

            if ($product->is_hero == 1) {
                $product->is_hero = 0;
                $product->save();

                return redirect()->back()->with('success', 'Asset tidak lagi menjadi hero.');
            } elseif ($currentHero && $currentHero->slug !== $slug) {
                $currentHero->is_hero = 0;
                $currentHero->save();

                $product->is_hero = 1;
                $product->save();

                return redirect()->back()->with('success', 'Asset tidak lagi menjadi hero.');
            } elseif (!$currentHero) {
                $product->is_hero = 1;
                $product->save();

                return redirect()->back()->with('success', 'Asset sekarang menjadi hero');
            } else {
                $product->is_hero = 1;
                $product->save();

                return redirect()->back()->with('success', 'Asset sekarang menjadi hero.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed. ' . $e->getMessage());
        }
    }
    public function changePhotoPrimary($id)
    {
        try {
            $photo = ProductPhoto::find($id);

            if ($photo) {
                $photo->is_primary = 1;
                $photo->save();

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

                $productPhotos = new ProductPhoto;
                $productPhotos->product_id = $request->id;
                $productPhotos->photo = $imgname;

                if (!$isPrimarySet) {
                    $productPhotos->is_primary = 1;
                    $isPrimarySet = true;
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
            if (auth()->user()->role_id == 1) {
                $products = Product::with(['category', 'productPhoto' => function ($query) {
                    $query->where('is_primary', 1);
                }])->get();
            } else {
                $products = Product::with(['category', 'productPhoto' => function ($query) {
                    $query->where('is_primary', 1);
                }])
                    ->where('user_uuid', auth()->user()->uuid)
                    ->get();
            }

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
            $tags = DB::table('tags')->get();

            return view('pages.admin.product.components.insert', compact('categories', 'tags'));
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
                //wajibun
                'name' => 'required',
                'short_desc' => 'required',
                'category_id' => 'required',
                'price' => 'required',
                'publish' => 'required',
                'is_hero' => 'required',
                'address' => 'required',
                'long_desc' => 'required',
                'gmaps' => 'required',
                'type_sales' => 'required',
                'no_pic' => 'required',
                'tags'        => 'required|array', // Ensure 'photos' is an array
                'photos'        => 'required|array', // Ensure 'photos' is an array
                'photos.*'      => 'image|mimes:jpeg,jpg,png|max:2048', // Validate each photo in the array
            ], [
                'photos.*.max' => 'Ukuran foto tidak boleh melebihi 2 MB.', // Custom error message for photo size
            ]);

            $cekIsSee = Product::where('is_hero', 1)->count();
            $msg = "";
            $is_hero = 0;
            if ($cekIsSee == 1 && $request->is_hero == 1) {
                $msg = "Asset tidak dijadikan asset utama";
                $is_hero = 0;
            }
            //slug
            $slugProduct = Str::slug($request->name) . '-' . uniqid();

            if (Product::where('name', $request->name)->exists()) {
                return redirect()->back()->with('error', 'Nama Aset tidak boleh sama dengan yang ada sebelumnya. Buat lebih unik.');
            }

            $product = Product::create([
                'user_uuid'     => auth()->user()->uuid,
                'category_id'   => $request->category_id,
                'name'          => $request->name,
                'short_desc'    => $request->short_desc,
                'price'         => $request->price,
                'publish'       => $request->publish,
                'is_hero'       => $is_hero,
                'slug'          => $slugProduct,
            ]);

            $fileSup = '';
            if ($request->hasFile('sup_doc')) {
                $extension = $request->file('sup_doc')->extension();
                $fileSup = date('dmyHis') . uniqid() . '.' . $extension;
                $path = Storage::putFileAs('public/sup_doc', $request->file('sup_doc'), $fileSup);
            }

            DetailProduct::create([
                'product_id'        => $product->id,
                'address'           => $request->address,
                'long_desc'         => $request->long_desc,
                'gmaps'             => $request->gmaps,
                'type_sales'        => $request->type_sales,
                'after_sale'        => $request->after_sale,
                'no_pic'            => $request->no_pic,
                'sup_doc'           => $fileSup,

                'surface_area'      => $request->surface_area,
                'building_area'     => $request->building_area,
                'bedroom'           => $request->bedroom,
                'bathroom'          => $request->bathroom,
                'floors'            => $request->floors,
                'certificate'       => $request->certificate,
                'garage'            => $request->garage,
                'electrical_power'  => $request->electrical_power,
                'building_year'     => $request->building_year,

                'chassis_number'    => $request->chassis_number,
                'machine_number'    => $request->machine_number,
                'brand'             => $request->brand,
                'series'            => $request->series,
                'kilometers'        => $request->kilometers,
                'cc'                => $request->cc,
                'type'              => $request->type,
                'color'             => $request->color,
                'transmission'      => $request->transmission,
                'vehicle_year'      => $request->vehicle_year,
                'date_stnk'         => $request->date_stnk,
            ]);

            if ($request->isScheduled) {
                AuctionSchedule::create([
                    'product_id' => $product->id,
                    'category_id' => $request->category_id,
                    'schedule' => $request->schedule,
                    'kpknl' => $request->kpknl,
                ]);
            }

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

            $tagsProduct = $request->tags;
            foreach ($tagsProduct as $tp) {
                $tagMapping = new ProductTagMapping;
                $tagMapping->product_id = $product->id;
                $tagMapping->tag_id = $tp;
                $tagMapping->save();
            }

            if ($request->isPublicFacilities) {
                AccessProductModel::create([
                    'product_id' => $product->id,
                    'hospital' => $request->hospital,
                    'school' => $request->school,
                    'bank' => $request->bank,
                    'market' => $request->market,
                    'house_of_worship' => $request->house_of_worship,
                    'cinema' => $request->cinema,
                    'halte' => $request->halte,
                    'airport' => $request->airport,
                    'toll' => $request->toll,
                    'mall' => $request->mall,
                    'park' => $request->park,
                    'pharmacy' => $request->pharmacy,
                    'restaurant' => $request->restaurant,
                    'station' => $request->station,
                    'gas_station' => $request->gas_station,
                    'others' => $request->others_fac_pub,
                ]);
            }

            if ($request->isAssetFacilities) {
                FacilitiesProduct::insert([
                    'product_id'        => $product->id,
                    'furnished'         => $request->furnished,
                    'swimming_pool'     => $request->swimming_pool,
                    'lift' => $request->lift,
                    'gym' => $request->gym,
                    'carport' => $request->carport,
                    'telephone' => $request->telephone,
                    'security' => $request->security,
                    'garage' => $request->fasgarage,
                    'park' => $request->faspark,
                    'others' => $request->others_fac_aset,
                ]);
            }

            if ($msg) {
                return redirect()->back()->with('success', 'Product added successfully! ' . $msg);
            }
            return redirect()->back()->with('success', 'Product added successfully! ');
        } catch (\Exception $e) {
            // DB::rollBack();
            dd($e->getMessage());
            // return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = DB::table('products')
                ->where('id', $id)
                ->first();

            $accessProduct = DB::table('access_products')->where('product_id', $id)->first();
            $auctionSchedule = DB::table('auction_schedules')->where('product_id', $id)->first();
            $detailProduct = DB::table('detail_products')->where('product_id', $id)->first();
            $facilitiesProduct = DB::table('facilities_tables')->where('product_id', $id)->first();
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

            return view('pages.admin.product.components.show', compact('accessProduct', 'auctionSchedule', 'facilitiesProduct', 'product', 'detailProduct', 'productPhotos', 'productTags', 'categories',));
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
                ->where('id', $id)
                ->first();


            $accessProduct = DB::table('access_products')->where('product_id', $id)->first();
            $auctionSchedule = DB::table('auction_schedules')->where('product_id', $id)->first();
            $detailProduct = DB::table('detail_products')->where('product_id', $id)->first();
            $facilitiesProduct = DB::table('facilities_tables')->where('product_id', $id)->first();
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
            $tags = DB::table('tags')->get();


            return view('pages.admin.product.components.edit', compact('accessProduct', 'auctionSchedule', 'facilitiesProduct', 'product', 'detailProduct', 'productPhotos', 'productTags', 'categories', 'tags'));
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
                'name'          => 'required|string',
                'short_desc'    => 'required|string',
                'category_id'   => 'required',
                'price'         => 'required',
                'publish'       => 'required|boolean',
                'is_hero'       => 'required|boolean',
                'address'       => 'required|string',
                'long_desc'     => 'required|string',
                'gmaps'         => 'required',
                'type_sales'    => 'required|string',
                'no_pic'        => 'required',

                'tags'        => 'required|array', // Ensure 'photos' is an array
            ]);

            $cekIsSee = Product::where('is_hero', 1)->count();
            $isHero = Product::where('is_hero', 1)->first();
            $msg = "";
            $is_hero = $request->is_hero;

            if (
                $cekIsSee == 1 && $request->is_hero == 1 && $isHero && $isHero->id != $id
            ) {
                $msg = "Asset tidak dijadikan asset utama";
                $is_hero = 0;
            }

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
                'is_hero'       => $is_hero,
                'slug'          => $slugProduct,
            ]);

            $dp                     = DetailProduct::where('product_id', $id)->first();
            $dp->product_id         = $id;
            $dp->address            = $request->address;
            $dp->long_desc          = $request->long_desc;
            $dp->gmaps              = $request->gmaps;
            $dp->type_sales         = $request->type_sales;
            $dp->after_sale      = $request->after_sale;
            $dp->no_pic             = $request->no_pic;

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


            $dp->surface_area      = $request->surface_area;
            $dp->building_area     = $request->building_area;
            $dp->bedroom           = $request->bedroom;
            $dp->bathroom          = $request->bathroom;
            $dp->floors            = $request->floors;
            $dp->certificate       = $request->certificate;
            $dp->garage            = $request->garage;
            $dp->electrical_power  = $request->electrical_power;
            $dp->building_year     = $request->building_year;

            $dp->chassis_number    = $request->chassis_number;
            $dp->machine_number    = $request->machine_number;
            $dp->brand             = $request->brand;
            $dp->series            = $request->series;
            $dp->kilometers        = $request->kilometers;
            $dp->cc                = $request->cc;
            $dp->type              = $request->type;
            $dp->color             = $request->color;
            $dp->transmission      = $request->transmission;
            $dp->vehicle_year      = $request->vehicle_year;
            $dp->date_stnk         = $request->date_stnk;
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

            //jadwal lelang
            if ($request->stateScheduled == '1') {
                AuctionSchedule::updateOrCreate(
                    ['product_id' => $id],
                    [
                        'category_id' => $request->category_id,
                        'schedule' => $request->schedule,
                        'kpknl' => $request->kpknl,
                    ]
                );
            }
            if ($request->stateScheduled == '2') {
                DB::table('auction_schedules')->where('product_id', $id)->delete();
            }

            //fasilitas public
            if ($request->statePublicFacilities == '1') {
                AccessProductModel::updateOrCreate(
                    ['product_id' => $id],
                    [
                        'hospital' => $request->hospital,
                        'school' => $request->school,
                        'bank' => $request->bank,
                        'market' => $request->market,
                        'house_of_worship' => $request->house_of_worship,
                        'cinema' => $request->cinema,
                        'halte' => $request->halte,
                        'airport' => $request->airport,
                        'toll' => $request->toll,
                        'mall' => $request->mall,
                        'park' => $request->park,
                        'pharmacy' => $request->pharmacy,
                        'restaurant' => $request->restaurant,
                        'station' => $request->station,
                        'gas_station' => $request->gas_station,
                        'others' => $request->others_fac_pub,
                    ]
                );
            }
            if ($request->statePublicFacilities == '2') {
                DB::table('access_products')->where('product_id', $id)->delete();
            }

            //fasilitas aset
            if ($request->stateAssetFacilities == '1') {
                FacilitiesProduct::updateOrInsert(
                    ['product_id' => $id],
                    [
                        'furnished'     => $request->furnished,
                        'swimming_pool' => $request->swimming_pool,
                        'lift'          => $request->lift,
                        'gym'           => $request->gym,
                        'carport'       => $request->carport,
                        'telephone'     => $request->telephone,
                        'security'      => $request->security,
                        'garage'        => $request->fasgarage,
                        'park'          => $request->faspark,
                        'others'        => $request->others_fac_aset,
                    ]
                );
            }
            if ($request->stateAssetFacilities == '2') {
                DB::table('facilities_tables')->where('product_id', $id)->delete();
            }


            if ($msg) {
                return redirect()->back()->with('success', 'Product updated successfully! ' . $msg);
            }
            return redirect()->back()->with('success', 'Product updated successfully! ');
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
            DB::table('access_products')->where('product_id', $id)->delete();
            DB::table('auction_schedules')->where('product_id', $id)->delete();
            DB::table('facilities_tables')->where('product_id', $id)->delete();
            DB::table('products')->where('id', $id)->delete();

            return redirect()->back()->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
