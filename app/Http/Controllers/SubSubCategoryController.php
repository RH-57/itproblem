<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SubSubCategoryController extends Controller
{
    public function index(Category $category, SubCategory $subcategory, SubSubCategory $subsubCategory): View
    {
        $subsubcategories = $subcategory->subSubCategories;
        return view('subsubcategory.index', compact('category', 'subcategory', 'subsubcategories'));
    }

    public function show(Category $category, SubCategory $subcategory, SubSubCategory $subsubCategory): View
    {
        return view('subsubcategories.show', compact('category', 'subcategory', 'subsubCategory'));
    }

    public function store(Request $request, Category $category, SubCategory $subcategory)
    {
        $request->validate([
            'name' => 'required|string|min:2'
        ]);

        // Membuat SubSubCategory baru terkait dengan subkategori yang dipilih
        $subcategory->subSubCategories()->create([
            'name' => $request->name
        ]);

        return redirect()->route('subsubcategories.index', ['category' => $category->slug, 'subcategory' => $subcategory->slug])
                         ->with('success', 'SubSubCategory berhasil ditambahkan');
    }

    public function update(Request $request, Category $category, SubCategory $subcategory, SubSubCategory $subsubcategory)
    {
        $request->validate([
            'name'  => 'required|string|min:2'
        ]);

        $subsubcategory->update([
            'name' => $request->name
        ]);

        return redirect()->route('subsubcategories.index', ['category' => $category->slug, 'subcategory' => $subcategory->slug])
                         ->with('success', 'SubSubCategory berhasil diupdate');
    }

    public function destroy(Category $category, SubCategory $subcategory, SubSubCategory $subsubcategory)
    {
        $subsubcategory->delete();
        return redirect()->route('subsubcategories.index', ['category' => $category->slug, 'subcategory' => $subcategory->slug])
                     ->with('success', 'Data Sub-Sub-Category berhasil dihapus');
    }
}
