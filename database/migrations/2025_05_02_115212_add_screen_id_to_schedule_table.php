<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sheets', function (Blueprint $table) {
            //
            $table->dropForeign(['screen_id']);
            $table->dropColumn('screen_id');
        });
        Schema::table('schedules', function (Blueprint $table) {
            // カラムを再追加
            $table->unsignedBigInteger('screen_id')->nullable()->comment('スクリーンID');
            // 外部キーを再追加
            $table->foreign('screen_id')->references('id')->on('screens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sheets', function (Blueprint $table) {
            $table->unsignedBigInteger('screen_id')->nullable()->comment('スクリーンID');
            $table->foreign('screen_id')->references('id')->on('screens')->onDelete('cascade');
        });
        Schema::table('schedules', function (Blueprint $table) {
            // 外部キーを削除
            $table->dropForeign(['screen_id']);
            // カラムを削除
            $table->dropColumn('screen_id');
        });
    }
};
