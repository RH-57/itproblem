<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\ProblemReport;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class ProblemReportController extends Controller
{
    public function index(): View
    {
        $categories = Category::withoutTrashed()->get();
        $branches = Branch::withoutTrashed()->get();
        $reports = ProblemReport::withoutTrashed()
                    ->with(['category', 'branch'])
                    ->orderBy('report_date','desc')
                    ->paginate(10);
        return view('problem.index', compact('reports', 'categories', 'branches'));
    }

    public function show($id): View
    {
        $reports = ProblemReport::with(['category', 'subCategory', 'subSubCategory', 'branch'])->findOrFail($id);
        return view('problem.show', compact('reports'));
    }

    public function getSubCategories($categoryId)
    {
        // Pastikan kategori yang dipilih ada
        $category = Category::findOrFail($categoryId);

        // Ambil sub-kategori terkait
        $subcategories = $category->subcategories; // Menggunakan relasi

        return response()->json($subcategories);
    }

    public function getSubSubCategories($subCategoryId)
    {
        // Pastikan sub-kategori yang dipilih ada
        $subCategory = SubCategory::findOrFail($subCategoryId);

        // Ambil sub-subkategori terkait
        $subsubcategories = $subCategory->subsubcategories; // Menggunakan relasi

        return response()->json($subsubcategories);
    }

    public function store(Request $request)
    {

        $request->validate([
            'category_id'       => 'required',
            'subcategory_id'    => 'required',
            'subsubcategory_id' => 'required',
            'branch_id'         => 'required',
            'user'              => 'required|string',
            'report_date'       => 'required|date',
            'detail_report'     => 'required|string',
            'cause'             => 'required|string',
            'solution'          => 'required|string',
            'by'                => 'required|string',
            'finish_date'       => 'required|date'
        ]);

        ProblemReport::create([
            'category_id'       => $request->category_id,
            'subcategory_id'    => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'branch_id'         => $request->branch_id,
            'user'              => $request->user,
            'report_date'       => $request->report_date,
            'detail_report'     => $request->detail_report,
            'cause'             => $request->cause,
            'solution'          => $request->solution,
            'by'                => $request->by,
            'finish_date'       => $request->finish_date
        ]);

        return redirect()->back()->with(['success' => 'Data Kerusakan Berhasil Ditambahkan']);
    }

    public function destroy($id)
    {
        $reports = ProblemReport::findOrFail($id);
        $reports->delete();
        return redirect()->route('problems.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
