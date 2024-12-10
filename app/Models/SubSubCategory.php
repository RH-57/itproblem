<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubSubCategory extends Model
{
    protected $table = 'sub_sub_categories';
    protected $fillable = [
        'sub_category_id',
        'name'
    ];

    use SoftDeletes;

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function reports()
    {
        return $this->hasMany(ProblemReport::class, 'subsubcategory_id');
    }
}
