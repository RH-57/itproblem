<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProblemReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardKerusakanController;
use App\Models\Branch;
use App\Models\Category;
use App\Models\ProblemReport;
use RealRashid\SweetAlert\Facades\Alert;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/kerusakan', [DashboardKerusakanController::class, 'index'])->name('dashboard.kerusakan.index');
    Route::resource('/dashboard/kerusakan', DashboardKerusakanController::class);
    Route::resource('/branches', App\Http\Controllers\BranchController::class);
    Route::resource('/categories', App\Http\Controllers\CategoryController::class);
    Route::resource('/categories/{category}/subcategories', App\Http\Controllers\SubcategoryController::class)->scoped([
        'subcategory' => 'slug'
    ]);
    Route::resource('/categories/{category:slug}/subcategories/{subcategory:slug}/subsubcategories',
        App\Http\Controllers\SubSubCategoryController::class);
    Route::get('/getSubCategories/{id}', [ProblemReportController::class, 'getSubCategories']);
    Route::get('/getSubSubCategories/{id}', [ProblemReportController::class, 'getSubSubCategories']);

    Route::resource('/problems', App\Http\Controllers\ProblemReportController::class);

    Route::resource('/dashboard/trend', App\Http\Controllers\TrendProblemController::class);
});

require __DIR__.'/auth.php';
