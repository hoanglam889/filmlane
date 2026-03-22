<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $fillable = [
        'movie_id', 
        'episode_number', 
        'video_link'
    ];

    // Tạo mối quan hệ: 1 Tập phim thuộc về 1 Bộ phim
    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id', 'id');
    }
}
