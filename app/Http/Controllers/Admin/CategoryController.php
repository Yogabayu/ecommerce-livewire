<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function changeVisibility($slug)
    {
        try {
            $category = Category::where('slug', $slug)->first();
            if ($category->status == 1) {
                $category->status = 0;
            } else {
                $category->status = 1;
            }
            $category->save();

            return redirect()->back()->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan update');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // $categories = Category::all();
            $categories = DB::table('categories')
                ->leftJoin('products', 'categories.id', '=', 'products.category_id')
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
                ->groupBy('categories.id', 'categories.name', 'categories.slug', 'categories.image', 'categories.status', 'categories.created_at', 'categories.updated_at')
                ->orderByDesc('prod_count')
                ->get();

            return view('pages.admin.category.index', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'      => 'required|string',
                'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
                'status'    => 'required|boolean',
            ]);

            $cekName = Category::where('name', '=', $request->name)->count();
            if ($cekName > 0) {
                return redirect()->back()->with("error", "Nama kategori sudah ada");
            }
            //slug
            $slug = Str::slug($request->name);

            // Check if a category with the same slug already exists
            $existingCategory = Category::where('slug', $slug)->first();

            if ($existingCategory) {
                // Generate a unique slug
                $slug = $slug . '-' . Str::random(5);
            }

            //save image
            $extension = $request->file('image')->extension();
            $imgname = date('dmyHis') . '.' . $extension;
            $path = Storage::putFileAs('public/categories', $request->file('image'), $imgname);

            //save data to Category model
            Category::create([
                'name'      => $request->name,
                'slug'      => $slug,
                'image'     => $imgname,
                'status'    => $request->status,
            ]);

            return redirect()->back()->with('success', 'Category added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
            // dd($e->getMessage());
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
    public function update(Request $request, $slug)
    {
        try {
            $request->validate([
                'name'      => 'required|string',
                'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
                'status'    => 'required|boolean',
            ]);

            $category = Category::where('slug', $request->slug)->firstOrFail();

            $slug = Str::slug($request->name);
            // Check if a category with the same slug already exists
            $existingSlug = Category::where('slug', $slug)->first();
            if ($existingSlug) {
                // Generate a unique slug
                $slug = $slug . '-' . Str::random(5);
                $category->slug = $slug;
            }

            $category->name = $request->name;
            $category->status = $request->status;

            if ($request->hasFile('image')) {
                // Handle image upload
                $extension = $request->file('image')->extension();
                $imgname = date('dmyHis') . '.' . $extension;
                $path = $request->file('image')->storeAs('public/categories', $imgname);

                // Remove old image
                if ($category->image) {
                    Storage::delete("public/categories/{$category->image}");
                }

                $category->image = $imgname;
            }
            $category->save();

            return redirect()->back()->with('success', 'Category updated successfully!');
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
            //delete category from storage and remove it from database
            $category = Category::where('id', $id)->firstOrFail();

            if ($category->image) {
                Storage::delete("public/categories/{$category->image}");
            }

            $category->delete();

            return redirect()->back()->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
