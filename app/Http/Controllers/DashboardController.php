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
        return view('index');
    }
}
