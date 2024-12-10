<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{

    public function index()
    {
        $subcategories = SubCategory::all();
        return response()->json($subcategories);
    }

    public function show(Category $category, SubCategory $subcategory, SubSubCategory $subsubCategory): View
    {
        return view('subsubcategory.index', compact('category', 'subcategory', 'subsubCategory'));
    }

    public function store(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|min:3'
        ]);

        $category->subCategories()->create([
            'name' => $request->name
        ]);

        return redirect()->route('categories.show', $category->slug)
                            ->with(['success' => 'Sub-Kategori berhasil ditambahkan']);
    }

    public function update(Request $request, Category $category, SubCategory $subcategory)
    {
        $request->validate([
            'name' => 'required|string|min:3' . $subcategory->slug . ',slug'
        ]);

        $subcategory->update([
            'name'  => $request->name
        ]);

        return redirect()->route('categories.show', $category->slug)
                            ->with(['success' => 'Sub-Kategori berhasil diupdate']);
    }

    public function destroy(Category $category, SubCategory $subcategory)
    {
        $subcategory->delete();

        return redirect()->route('categories.show', $category->slug)
                        ->with(['success' => 'Sub-Kategori berhasil dihapus']);
    }
}
