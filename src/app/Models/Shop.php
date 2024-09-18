<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'area_id',
        'genre_id',
        'image_url',
        'outline'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
           $query->where('word', 'like', '%' . $keyword . '%');
        }
    }

    public function scopeAreaSearch($query, $area_id)
    {
        if (!empty($area_id)) {
           $query->where('area_id', $area_id);
        }
        return $query->where('area_id', $area_id);
    }

    public function scopeGenreSearch($query, $genre_id)
    {
        return $query->where('genre_id', $genre_id);
    }
}
