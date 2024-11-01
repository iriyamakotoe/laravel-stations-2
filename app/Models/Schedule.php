<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    // マスアサインメント可能な属性を定義
    protected $fillable = [
        'movie_id',
        'start_time',
        'end_time',
    ];

    // デフォルトで Carbon インスタンスとして扱いたいカラムを指定
    protected $casts = [
        'start_time' => 'datetime:H:i:s',
        'end_time' => 'datetime:H:i:s',
    ];
    public function movie()
    {
        return $this->belongsTo(Movie::class);
        
    }
    public function screen()
    {
        return $this->belongsTo(Screen::class);
        
    }

}
