<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Schedule;
use App\Models\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    // 映画詳細から遷移する席予約ページ表示
    public function getSheets($movie_id,$schedule_id,Request $request)
    {
        // クエリパラメータ 'date' を取得
        $date = $request->query('date');

        // 映画とスケジュールが存在するか確認
        $movie = Movie::find($movie_id);
        $schedule = Schedule::find($schedule_id);

        if (!$movie || !$schedule || !$date) {
            // 映画またはスケジュールが見つからない場合、400エラーを返す
            return response()->json(['error' => 'Invalid movie or schedule ID'], 400);
        }
    
        // 席の取得
        $sheets = Sheet::all();

        // 複合ユニークのチェック：既に予約済みの席があるかどうかを判定
        $reservedSheets = Reservation::where('schedule_id', $schedule_id)
        ->where('date', $date)
        ->pluck('sheet_id') // 予約されている sheet_id のリストを取得
        ->toArray();

        // 席情報を加工して、予約されているかどうかのフラグを付与
        $sheets = $sheets->map(function ($sheet) use ($reservedSheets) {
            $sheet->is_reserved = in_array($sheet->id, $reservedSheets);
            return $sheet;
        });

        return view('reservationSheets', [
            'date' => $date,
            'movie_id' => $movie_id,
            'schedule_id' => $schedule_id,
            'sheets' => $sheets
        ]);
    }

    // 席予約フォーム表示
    public function createReservation($movie_id,$schedule_id,Request $request)
    {
        // クエリパラメータを取得
        $date = $request->query('date');
        $sheet_id = $request->query('sheetId');

        // パラメータが存在しない場合は400エラーを返す
        if (!$date || !$sheet_id) {
            // ここでビューにリダイレクトするか、エラーとしてステータス400を返す
            abort(400, 'Date or sheetId is missing');
        }

        $movie = Movie::findOrFail($movie_id);
        $schedule = Schedule::findOrFail($schedule_id);
        $sheet = Sheet::findOrFail($sheet_id);

        if (!$movie || !$schedule) {
            return response()->json(['error' => 'Invalid movie or schedule ID'], 400);
        }

        // 既に予約済みの席があるかどうかを判定
        $existingReservation = Reservation::where('schedule_id', $schedule_id)
            ->where('date', $date)
            ->where('sheet_id', $sheet_id)
            ->first();

        if ($existingReservation) {
            // 予約が既に存在する場合、400エラーを返す
            abort(400, 'This seat is already reserved');
        }

        return view('createReservation', [
            'date' => $date,
            'movie' => $movie,
            'schedule' => $schedule,
            'sheet' => $sheet
        ]);
    }

    // 席予約フォーム投稿
    public function postReservation(Request $request)
    {
        $movie_id = $request->movie_id;
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'schedule_id' => 'required|exists:schedules,id',
            'sheet_id' => 'required|exists:sheets,id',
            'date' => 'required',
            // 複合ユニーク制約のバリデーション
            'schedule_id,sheet_id' => 'unique:reservations,NULL,id,schedule_id,' . $request->schedule_id . ',sheet_id,' . $request->sheet_id,
        ]);
        try {
            DB::transaction(function () use ($request) {
                $post = new Reservation();
                $post->schedule_id = $request->schedule_id;
                $post->sheet_id = $request->sheet_id;
                $post->date = $request->date;
                $post->email = $request->email;
                $post->name = $request->name;
                $post->is_canceled = false;
                $post->save();
            });
    
            return redirect("/movies/{$movie_id}")->with('success', '予約が完了しました。');
    
        } catch (\Illuminate\Database\QueryException $e) {
            // 重複エントリーのエラーをキャッチ
            if ($e->getCode() == '23000') {
                return redirect("/movies/{$movie_id}/schedules/{$request->schedule_id}/sheets?date={$request->date}")->withErrors(['duplicate' => '既に予約が存在します。']);
            }
            // その他のエラーは再スロー
            throw $e;
        }
    }
}
