<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // Genreは複数のMoviesを持つことができる
    public function movies()
    {
        return $this->hasMany(Movie::class, 'genre_id');
    }
}
