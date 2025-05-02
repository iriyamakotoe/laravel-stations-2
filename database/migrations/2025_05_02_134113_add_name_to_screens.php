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
        Schema::table('screens', function (Blueprint $table) {
            //
            Schema::table('screens', function (Blueprint $table) {
                $table->string('name'); // nameカラムを追加
                $table->string('screen')->nullable()->default('')->change();
            });
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('screens', function (Blueprint $table) {
            //
            Schema::table('screens', function (Blueprint $table) {
                $table->dropColumn('name'); // 元に戻す処理
                $table->string('screen')->nullable(false)->default(null)->change();
            });    
        });
    }
};
