<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    // Movieは1つのGenreに属する
    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
        
    }
}
