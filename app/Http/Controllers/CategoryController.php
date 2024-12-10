<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withoutTrashed()->get();
        return view('category.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $subcategories = $category->subCategories;
        return view('subcategory.index', compact('category', 'subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|unique:categories,name'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with(['success' => 'Data Kategori Berhasil Ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3|unique:categories,name'
        ]);

        $categories = Category::findOrFail($id);
        $categories->update([
            'name'  => $request->name
        ]);

        return redirect()->back()->with(['success' => 'Data Kategori Berhasil Diupdate']);
    }

    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();

        return redirect()->route('categories.index')->with(['success' => 'Kategori Berhasil Dihapus']);
    }
}
