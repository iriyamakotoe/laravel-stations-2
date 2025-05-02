<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'movie_id',
        'screen_id',
        'start_time',
        'end_time'
    ];

    // public function schedules()
    // {
    //     return $this->hasMany(Schedule::class, 'screen_id');
    // }
}
