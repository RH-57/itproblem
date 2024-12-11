<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProblemReport;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(): View
    {
        Carbon::setLocale('id');
        $reportCount = ProblemReport::count();
        $branchCount = Branch::count();
        $categoryCount = Category::count();

        //$categories = Category::all();
        $subCategories = SubCategory::all();
        $subSubCategories = SubSubCategory::all();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $categories = Category::take(3)->get(); // Ambil 3 kategori (sesuaikan logika filter)
        $trendDataByCategory = [];

        foreach ($categories as $category) {
            $data = ProblemReport::withoutTrashed()->select(
                    DB::raw('YEAR(report_date) as year'), // Ambil tahun
                    DB::raw('COUNT(*) as total_damage')  // Total kerusakan
                )
                ->where('category_id', $category->id) // Filter berdasarkan kategori
                ->where('report_date', '>=', Carbon::now()->subYears(3)->startOfYear()) // Data 5 tahun terakhir
                ->groupBy(DB::raw('YEAR(report_date)')) // Grup berdasarkan tahun
                ->orderBy('year')
                ->get();

            // Simpan data kategori
            $trendDataByCategory[] = [
                'label' => $category->name, // Nama kategori
                'data' => $data->pluck('total_damage')->toArray(), // Nilai kerusakan
                'years' => $data->pluck('year')->toArray() // Tahun
            ];
        }

        $allYears = collect($trendDataByCategory)->flatMap(fn($item) => $item['years'])->unique()->sort()->values();


        //Menampilkan chart kerusakan menurut kategori
        $categoryDamageData = ProblemReport::withoutTrashed()->select('category_id', DB::raw('count(*) as total_damage'))  // Filter berdasarkan tahun berjalan
                                    ->groupBy('category_id')
                                    ->get();

        // Siapkan data untuk chart
        $categoryLabels = $categories->pluck('name')->toArray();  // Nama kategori sebagai labels
        $categoryData = $categories->map(function ($category) use ($categoryDamageData) {
            // Mencocokkan kategori dan jumlah kerusakan yang sesuai
            $damage = $categoryDamageData->firstWhere('category_id', $category->id);
            return $damage ? $damage->total_damage : 0; // Jika tidak ada data, set 0
        })->toArray(); // Data jumlah kerusakan


        //Menampilkan chart kerusakan menurut subkategori
        $subCategoryDamageData = ProblemReport::withoutTrashed()->select('subcategory_id', DB::raw('count(*) as total_damage'))
                                                ->groupBy('subcategory_id')
                                                ->get();

        $subCategoryLabels = $subCategories->pluck('name')->toArray();
        $subCategoryData = $subCategories->map(function ($subCategory) use ($subCategoryDamageData) {
        $damage = $subCategoryDamageData->firstWhere('subcategory_id', $subCategory->id);
        return $damage ? $damage->total_damage : 0;
        })->toArray();


        $subSubCategoryDamageData = ProblemReport::withoutTrashed()->select('subsubcategory_id', DB::raw('count(*) as total_damage'))
                                                ->groupBy('subsubcategory_id')
                                                ->get();

        $subSubCategoryLabels = $subSubCategories->pluck('name')->toArray();
        $subSubCategoryData = $subSubCategories->map(function ($subSubCategory) use ($subSubCategoryDamageData) {
        $damage = $subSubCategoryDamageData->firstWhere('subsubcategory_id', $subSubCategory->id);
        return $damage ? $damage->total_damage : 0;
        })->toArray();

        //Menampilkan user yf paling banyak melapor
        $mostActiveUser = ProblemReport::withoutTrashed()->select('user', DB::raw('count(*) as report_count'))
                                        ->groupBy('user')
                                        ->orderBy('report_count', 'DESC')
                                        ->take(5)
                                        ->get();  // Ambil user dengan laporan terbanyak

        //menampilkan list subsubkategori yang sering rusak
        $mostDamagedParts = ProblemReport::withoutTrashed()->select('sub_sub_categories.name', DB::raw('count(problem_reports.id) as total_damage'))
                                        ->join('sub_sub_categories', 'problem_reports.subsubcategory_id', '=', 'sub_sub_categories.id')
                                        ->groupBy('sub_sub_categories.name')
                                        ->orderBy('total_damage', 'DESC')
                                        ->take(5) // Menampilkan 5 sub-sub-kategori teratas
                                        ->get();

        return view('index', compact(
            'reportCount',
            'branchCount',
            'categoryCount',
            'categoryLabels',
            'categoryData',
            'subCategoryLabels',
            'subCategoryData',
            'subSubCategoryLabels',
            'subSubCategoryData',
            'mostActiveUser',
            'mostDamagedParts',
            'trendDataByCategory',
            'allYears'
        ));
    }
}
