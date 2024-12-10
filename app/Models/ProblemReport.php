<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProblemReport extends Model
{
    use SoftDeletes;

    protected $table  = 'problem_reports';
    protected $fillable = [
        'report_date',
        'category_id',
        'subcategory_id',
        'subsubcategory_id',
        'branch_id',
        'user',
        'detail_report',
        'cause',
        'solution',
        'finish_date',
        'by'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function subSubCategory()
    {
        return $this->belongsTo(SubSubCategory::class, 'subsubcategory_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
