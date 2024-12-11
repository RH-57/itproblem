<?php

namespace App\Http\Controllers;

use App\Models\ProblemReport;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendProblemController extends Controller
{
    public function index(Request $request): View
    {
        // Tahun dipilih dari filter, default ke tahun ini
        $selectedYear = $request->input('year', Carbon::now()->year);

        //Total kerusakan sesuai tahun yang dipilih
        $totalReportInYear = ProblemReport::withoutTrashed()
            ->whereYear('report_date', $selectedYear)
            ->count();

        // Ambil data kategori dan kerusakan
        $trendDataByCategory = ProblemReport::withoutTrashed()
            ->join('categories', 'problem_reports.category_id', '=', 'categories.id')
            ->select(
                DB::raw('MONTH(problem_reports.report_date) as month'),
                DB::raw('categories.name as category_name'),
                DB::raw('COUNT(*) as total_damage')
            )
            ->whereYear('problem_reports.report_date', $selectedYear)
            ->groupBy('month', 'category_name')
            ->orderBy('month')
            ->get();

        $frequentSubSubCategories = ProblemReport::withoutTrashed()
            ->join('sub_sub_categories', 'problem_reports.subsubcategory_id', '=', 'sub_sub_categories.id')
            ->select(
                DB::raw('sub_sub_categories.name as sub_sub_category_name'),
                DB::raw('COUNT(*) as total_damage')
            )
            ->whereYear('problem_reports.report_date', $selectedYear)
            ->groupBy('sub_sub_category_name')
            ->orderByDesc('total_damage')
            ->take(5) // Ambil 5 sub-subkategori paling sering rusak
            ->get();

         // Data user yang paling sering melapor
        $frequentReporters = ProblemReport::withoutTrashed()
            ->select(
                DB::raw('user as user_name'),
                DB::raw('COUNT(*) as total_reports')
            )
            ->whereYear('problem_reports.report_date', $selectedYear)
            ->groupBy('user_name')
            ->orderByDesc('total_reports')
            ->take(5)
            ->get();

        // Struktur data untuk Chart.js
        $categories = $trendDataByCategory->pluck('category_name')->unique();
        $months = range(1, 12); // Semua bulan
        $trendData = [];

        foreach ($categories as $category) {
            $categoryData = $trendDataByCategory->where('category_name', $category);
            $monthlyData = [];

            foreach ($months as $month) {
                $monthlyData[] = $categoryData->firstWhere('month', $month)->total_damage ?? 0;
            }

            $trendData[] = [
                'label' => $category,
                'data' => $monthlyData
            ];
        }

        return view('trend.index', compact('trendData', 'months', 'selectedYear', 'totalReportInYear', 'frequentSubSubCategories', 'frequentReporters'));
    }
}
