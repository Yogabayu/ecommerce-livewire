<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::all();

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
                'slug'      => 'required|unique:categories,slug',
                'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
                'status'    => 'required|boolean',
            ]);

            //save image
            $extension = $request->file('image')->extension();
            $imgname = date('dmyHis') . '.' . $extension;
            $path = Storage::putFileAs('public/categories', $request->file('image'), $imgname);

            //slug
            $slug = Str::slug($request->slug);

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
                'slug'      => 'required|string',
                'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
                'status'    => 'required|boolean',
            ]);

            $category = Category::where('slug', $slug)->firstOrFail();

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

            // Check if the requested slug is different from the current slug
            if ($request->slug !== $category->slug) {
                // Generate a unique slug
                $slug = Str::slug($request->slug);
                $cekSlug = Category::where('slug', $slug)->count();
                if ($cekSlug > 0) {
                    $slug = $slug . '-' . Str::random(5);
                }
                $category->slug = $slug;
            }

            $category->name = $request->name;
            $category->status = $request->status;
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
