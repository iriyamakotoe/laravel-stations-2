<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function sheet()
    {
        return $this->belongsTo(Sheet::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
