<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SubCategory extends Model
{
    protected $table = 'sub_categories';
    protected $fillable = [
        'category_id',
        'name',
        'slug'
    ];

    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subSubCategories()
    {
        return $this->hasMany(SubSubCategory::class);
    }

    public function reports()
    {
        return $this->hasMany(ProblemReport::class, 'subcategory_id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($subcategory) {
            $subcategory->slug = Str::slug($subcategory->name);
        });

        static::updating(function ($subcategory) {
            $subcategory->slug = Str::slug($subcategory->name);
        });

        static::deleting(function($subcategory) {
            $subcategory->subSubCategories->each(function ($subSubCategory) {
                $subSubCategory->delete();
            });
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
