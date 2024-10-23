<?php
namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ScheduleController extends Controller
{
    public function adminSchedule()
    {
        // 昇順でソート
        $movies = Movie::with(['schedules' => function ($query) {
            $query->orderBy('start_time', 'asc'); // 'asc'で昇順
        }])->get();
        $schedules = Schedule::all();

        return view('adminSchedule', [
            'movies' => $movies,
            'schedules' => $schedules,
        ]);

    }
    public function detailSchedule($id) 
    { 
        // 昇順でソート
        $schedule = Schedule::findOrFail($id);

        return view('detailSchedule', [
            'schedule' => $schedule,
        ]);
    }
    public function createSchedule($id)
    {
        return view('createSchedule', ['movie_id' => $id,]);
    }
    public function postSchedule(Request $request,$id) 
    { 
        $validated = $request->validate([
            'movie_id' => 'required',
            'start_time_date' => 'required|date_format:Y-m-d',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_date' => 'required|date_format:Y-m-d',
            'end_time_time' => 'required|date_format:H:i',
        ]);

        // 開始日時と終了日時をCarbonで組み合わせる
        $startTime = Carbon::createFromFormat('Y-m-d H:i', $validated['start_time_date'] . ' ' . $validated['start_time_time']);
        $endTime = Carbon::createFromFormat('Y-m-d H:i', $validated['end_time_date'] . ' ' . $validated['end_time_time']);

        // カスタムバリデーション
        if ($startTime->gt($endTime)) {
            return back()->withErrors([
                'start_time_date' => '開始日時は終了日時より前でなければなりません。',
                'end_time_date' => '終了日時は開始日時より後でなければなりません。',
                'start_time_time' => '開始日時は終了日時より前でなければなりません。',
                'end_time_time' => '終了日時は開始日時より後でなければなりません。',
            ])->withInput();
        }

        if ($startTime->eq($endTime)) {
            return back()->withErrors([
                'start_time_time' => '開始時間と終了時間を同じにすることはできません。',
                'end_time_time' => '開始時間と終了時間を同じにすることはできません。',
            ])->withInput();
        }

        if ($startTime->diffInMinutes($endTime) < 6) {
            return back()->withErrors([
                'start_time_time' => '開始時間と終了時間の差は5分以上にする必要があります。',
                'end_time_time' => '開始時間と終了時間の差は5分以上にする必要があります。',
            ])->withInput();
        }

        DB::transaction(function () use ($request, $validated, $id, $startTime, $endTime) {
            $post = new Schedule();
            $post->movie_id = $id;
            $post->start_time = $startTime;
            $post->end_time = $endTime;
            $post->save();
        });

        return redirect('/admin/schedules');
     }
     public function editSchedule($id)
     {
        $schedule = Schedule::findOrFail($id);
        return view('editSchedule', [
            'schedule' => $schedule
        ]);
     }
     public function patchSchedule(Request $request, $id) 
     { 
        // バリデーション
        $validated = $request->validate([
            'movie_id' => 'required',
            'start_time_date' => 'required|date_format:Y-m-d',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_date' => 'required|date_format:Y-m-d',
            'end_time_time' => 'required|date_format:H:i',
        ]);

        // 開始日時と終了日時をCarbonで組み合わせる
        $startTime = Carbon::createFromFormat('Y-m-d H:i', $validated['start_time_date'] . ' ' . $validated['start_time_time']);
        $endTime = Carbon::createFromFormat('Y-m-d H:i', $validated['end_time_date'] . ' ' . $validated['end_time_time']);

        // カスタムバリデーション
        if ($startTime->gt($endTime)) {
            return back()->withErrors([
                'start_time_date' => '開始日時は終了日時より前でなければなりません。',
                'end_time_date' => '終了日時は開始日時より後でなければなりません。',
                'start_time_time' => '開始日時は終了日時より前でなければなりません。',
                'end_time_time' => '終了日時は開始日時より後でなければなりません。',
            ])->withInput();
        }

        if ($startTime->eq($endTime)) {
            return back()->withErrors([
                'start_time_time' => '開始時間と終了時間を同じにすることはできません。',
                'end_time_time' => '開始時間と終了時間を同じにすることはできません。'
            ])->withInput();
        }

        if ($startTime->diffInMinutes($endTime) < 6) {
            return back()->withErrors([
                'start_time_time' => '開始時間と終了時間の差は5分以上にする必要があります。',
                'end_time_time' => '開始時間と終了時間の差は5分以上にする必要があります。'
            ])->withInput();
        }

        // トランザクションでデータ更新
        DB::transaction(function () use ($request, $validated, $id, $startTime, $endTime) {

            // 該当するスケジュールを取得
            $schedule = Schedule::findOrFail($id);

            // 取得したスケジュールを更新
            $schedule->movie_id = $schedule->movie_id;
            $schedule->start_time = $startTime;
            $schedule->end_time = $endTime;
            $schedule->save();
        });

        // 更新後のリダイレクト
        return redirect('/admin/schedules')->with('success', 'スケジュールが更新されました');
      }
    public function deleteSchedule($id) 
    { 
        $movie = Schedule::findOrFail($id);

        // データが存在すれば削除
        $movie->delete();

        // 成功メッセージをフロントエンドに返す
        return redirect('/admin/schedules')->with('success', 'スケジュールが削除されました');
    }


}