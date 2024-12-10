<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'code',
        'name'
    ];

    public function reports()
    {
        return $this->hasMany(ProblemReport::class, 'branch_id');
    }
}
