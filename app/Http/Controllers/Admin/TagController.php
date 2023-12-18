<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tags = DB::table('tags')
                ->leftJoin('product_tag_mappings', 'tags.id', '=', 'product_tag_mappings.tag_id')
                ->select('tags.*', DB::raw('COUNT(product_tag_mappings.tag_id) as tag_count'))
                ->groupBy('tags.id', 'tags.name')
                ->orderBy('tag_count', 'desc')
                ->get();

            return view("pages.admin.tag.index", compact("tags"));
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
                'tagsInput' => 'required|string',
            ]);

            $tagsArray = explode(',', $request->tagsInput);

            foreach ($tagsArray as $tagName) {
                Tag::create(['name' => trim($tagName)]);
            }

            return redirect()->back()->with("success", "Berhasil menambah tag");
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
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                "name" => "required",
            ]);

            Tag::findOrFail($id)->update([
                "name" => $request->name,
            ]);

            return redirect()->back()->with("success", "Berhasil menambah tag");
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
            $tag = Tag::find($id);
            $tag->delete();

            return redirect()->back()->with("success", "Berhasil menghapus data");
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
