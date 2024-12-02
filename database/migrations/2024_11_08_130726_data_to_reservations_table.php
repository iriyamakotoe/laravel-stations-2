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
        Schema::table('reservations', function (Blueprint $table) {
        // データを移行するメソッドを実行
        $this->data();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            //
        });
    }

    public function data()
    {
        // reservationsテーブルの既存データを取得
        $reservations = DB::table('reservations')->get();
    
        foreach ($reservations as $reservation) {
            // emailを使ってusersテーブルからユーザーを取得
            $user = DB::table('users')->where('email', $reservation->email)->first();
    
            if ($user) {
                // ユーザーが存在する場合、reservationのuser_idを更新
                DB::table('reservations')->where('id', $reservation->id)->update([
                    'user_id' => $user->id, // user_idをusersテーブルのIDに設定
                ]);
    
                // reservationsテーブルのnameをusersテーブルのnameで更新
                DB::table('users')->where('email', $reservation->email)->update([
                    'name' => $reservation->name, // reservationテーブルのnameをusersテーブルに反映
                ]);
            }
        }
    }
};
