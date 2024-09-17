<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenreToMovies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            // カラム追加
            $table->unsignedBigInteger('genres_id')->nullable()->after('id');
            // カラムの外部キー制約追加
            $table->foreign('genres_id')->references('id')->on('genres')->OnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            // 外部キーとカラムを削除
            $table->dropForeign(['genres_id']);
            $table->dropColumn('genres_id');
        });
    }
}
