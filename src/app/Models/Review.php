<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['restaurant_id', 'user_id', 'rating', 'comment'];

    use HasFactory;

    // レビューは1つの飲食店に紐づく
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    // レビューは1人のユーザーによって書かれる
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
