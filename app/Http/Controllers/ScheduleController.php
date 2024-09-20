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
    public function createSchedule()
    {
        return view('createSchedule', []);
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

        DB::transaction(function () use ($request,$validated, $id) {
            // 開始日時と終了日時をCarbonで組み合わせる
            $startTime = Carbon::createFromFormat('Y-m-d H:i', $validated['start_time_date'] . ' ' . $validated['start_time_time']);
            $endTime = Carbon::createFromFormat('Y-m-d H:i', $validated['end_time_date'] . ' ' . $validated['end_time_time']);

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

        // トランザクションでデータ更新
        DB::transaction(function () use ($request, $validated, $id) {
            // 開始日時と終了日時をCarbonで組み合わせる
            $startTime = Carbon::createFromFormat('Y-m-d H:i', $validated['start_time_date'] . ' ' . $validated['start_time_time']);
            $endTime = Carbon::createFromFormat('Y-m-d H:i', $validated['end_time_date'] . ' ' . $validated['end_time_time']);

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