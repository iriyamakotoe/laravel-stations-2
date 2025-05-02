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
        //
        Schema::table('movies', function (Blueprint $table) {
            // 既存の image_url カラムを変更
            $table->string('image_url')->nullable()->default('')->change();
            $table->string('published_year')->nullable()->default('')->change();
            $table->string('is_showing')->nullable()->default('')->change();
            $table->string('description')->nullable()->default('')->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('movies', function (Blueprint $table) {
            $table->string('image_url')->nullable(false)->default(null)->change();
            $table->string('published_year')->nullable(false)->default(null)->change();
            $table->string('is_showing')->nullable(false)->default(null)->change();
            $table->string('description')->nullable(false)->default(null)->change();
        });

    }
};
