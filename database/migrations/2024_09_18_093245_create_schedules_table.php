<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('movie_id');
            // 外部キー制約を追加し、moviesテーブルのidを参照
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            // インデックスを追加
            $table->index('movie_id');

            $table->date('start_time');
            $table->date('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
