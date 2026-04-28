<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 1. GỌI NÓ RA Ở ĐÂY NÈ SẾP

class Movie extends Model
{
    use SoftDeletes; // 2. BẬT CÔNG TẮC BÊN TRONG CLASS NÀY

    // Cấp phép cho các cột này được nhận dữ liệu trực tiếp từ Form
    protected $fillable = [
        'title', 
        'slug',
        'description',
        'year', 
        'resolution', 
        'image', 
        'category_id',
        'country_id',
        'subtitle_type',
        'is_upcoming',
        'is_top_rated',
        'is_trending',
        'status',
        'is_series',
    ];
    public function episodes()
    {
        return $this->hasMany(Episode::class, 'movie_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}