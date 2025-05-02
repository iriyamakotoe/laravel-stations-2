<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'movie_id',
        'screen_id',
        'image_url',
        'published_year',
        'is_showing',
        'description',
        'start_time',
        'end_time'
    ];
    

    // Movieは1つのGenreに属する
    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
        
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'movie_id');
    }
}
