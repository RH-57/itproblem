<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function reports()
    {
        return $this->hasMany(ProblemReport::class, 'category_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            //softdelete semua subkategori terkait
            $category->subCategories->each(function ($subCategory) {
                $subCategory->delete();

                //sofdelete semua subsubkategori terkait
                $subCategory->subSubCategories->each(function ($subSubCategory) {
                    $subSubCategory->delete();
                });
            });
        });

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
