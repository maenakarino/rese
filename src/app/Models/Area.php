<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'area'
    ];

    public function shops()
    {
        return $this->hasMany(Shop::class, 'area_id');
    }

    public function scopeCategorySearch($query, $area_id)
    {
        if (!empty($area_id)) {
            $query->where('area_id', $area_id);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
           $query->where('content', 'like', '%' . $keyword . '%');
        }
    }
}
