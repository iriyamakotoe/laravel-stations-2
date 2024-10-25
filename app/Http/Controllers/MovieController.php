<?php
namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class MovieController extends Controller
{
    public function index(Request $request)
    {
        
        // クエリパラメータから検索条件を取得
        $query = Movie::query();

        // 名前での検索を実行
        $keyword = $request->input('keyword');
        $isShowing = $request->input('is_showing');

        if ($request->filled('keyword')) {
            $query->where('title', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('description', 'LIKE', '%' . $keyword . '%');
        }
        if ($isShowing !== null && $isShowing !== 'all') {
            $query->where('is_showing', intval($isShowing));
        }

        // クエリパラメータがない場合、全データを表示するなどのデフォルト動作
        if (!$request->filled('keyword') && $isShowing === null) {
            // $movies = Movie::all();
        }

        // ページネーションを設定（例：1ページあたり15件）
        $movies = $query->paginate(20)->appends([
            'keyword' => $keyword,
            'is_showing' => $isShowing
        ]);

        return view('index', [
            'movies' => $movies,
            'keyword' => $keyword,
            'isShowing' => $isShowing
        ]);
    }
    public function admin()
    {
        $movies = Movie::with('genre')->get();
        // $movies = Movie::with('genre')->findOrFail($id);
        // ジャンルがnullの場合の処理
        return view('admin', [
            'movies' => $movies
        ]);
    }
    public function createMovie()
    {
        return view('createMovie');
    }

    public function postMovie(Request $request) 
    { 
        $validated = $request->validate([
            'title' => 'required|unique:movies',
            'image_url' => 'required|active_url',
            'published_year' => 'required|numeric',
            'is_showing' => 'required',           
            'description' => 'required',        
            'genre' => 'required',     
        ]);

        DB::transaction(function () use ($request) {
            $genre = new Genre();
            // 入力されたジャンル名を取得
            $genreName = $request->input('genre');
            // genresテーブルで該当のジャンル名が存在するか確認
            $genre = Genre::where('name', $genreName)->first();
            if ($genre) {
                // ジャンルが既に存在する場合は何もしない
                $genreId = $genre->id;
            } else {
                // ジャンルが存在しない場合、新規に作成
                $genre = Genre::create(['name' => $genreName]);
                $genreId = $genre->id;
            }
            $genre->save();

            $post = new Movie();
            $post->title = $request->input('title');
            $post->image_url = $request->input('image_url');
            $post->published_year = $request->input('published_year');
            $is_showing = $request->input('is_showing');
            if($is_showing=="is_showing") {
                $is_showing = true;
            } elseif($is_showing=="not_showing") {
                $is_showing = false;
            }
            $post->is_showing = $is_showing;
            $post->description = $request->input('description');
            $post->genre_id = $genreId;
            $post->save();
        });

        return redirect('/admin/movies');
     }
     public function editMovie($id)
     {
        $movies = Movie::with('genre')->findOrFail($id);
        // ジャンルがnullの場合の処理
        if (is_null($movies->genre)) {
            // ジャンルがない場合の処理
            // 例: デフォルトのジャンルを設定する、エラーメッセージを表示するなど
            $genreName = '';
        } else {
            // ジャンルが存在する場合の処理
            $genreName = $movies->genre->name;
        }
        return view('editMovie', [
            'movies' => $movies,
            'genreName' => $genreName,
        ]);
     }
     public function patchMovie(Request $request, $id) 
     { 
         $validated = $request->validate([
             'title' => 'required|unique:movies',
             'image_url' => 'required|active_url',
             'published_year' => 'required|numeric',
             'is_showing' => 'required',           
             'description' => 'required',
             'genre' => 'required', 
         ]);

        //  try {
            // 入力された上映状態を取得
            $is_showing = $request->is_showing;
            if($is_showing=="is_showing") {
                $is_showing = true;
            } elseif($is_showing=="not_showing") {
                $is_showing = false;
            }

            DB::transaction(function () use ($request, $id,$is_showing) {
                // 入力されたジャンル名を取得
                $genreName = $request->input('genre');
                // genresテーブルで該当のジャンル名が存在するか確認
                $genre = Genre::firstOrCreate(['name' => $genreName]);
                // 新規に作成されたジャンルまたは既存のジャンルのIDを取得
                $genreId = $genre->id;

                Movie::where("id", $id)->update([
                "title" => $request->title,
                "image_url" => $request->image_url,
                "published_year" => $request->published_year,
                "is_showing" => $is_showing,
                "description" => $request->description,
                'genre_id' => $genreId,
                ]);
            });

            return redirect('/admin/movies');
        // } catch (QueryException $e) {
        //     // 重複エラーをキャッチして、エラーメッセージをフロントに表示
        //     if ($e->errorInfo[1] == 1062) { // MySQLの重複エラーコードは1062
        //         return redirect()->back()->withErrors(['title' => 'このタイトルは既に使用されています。']);
        //     }
        //     // 他の例外処理
        //     return redirect()->back()->withErrors(['error' => $e->errorInfo[2] . '何か問題が発生しました。']);
        // }
      }
    public function deleteMovie($id) 
    { 
        $movie = Movie::findOrFail($id);

        // データが存在すれば削除
        $movie->delete();

        // 成功メッセージをフロントエンドに返す
        return redirect()->back()->with('success', '削除しました。');
    }

    public function sheets() 
    { 
         $sheets = Sheet::all();
 
         return view('sheets', [
            'sheets' => $sheets
        ]);
    }

    public function detailMovie($id) 
    { 
        // 昇順でソート
        $movie = Movie::with(['genre', 'schedules' => function ($query) {
            $query->orderBy('start_time', 'asc');
        }])->findOrFail($id);
        $today = Carbon::today()->format('Y-m-d');;

        return view('detailMovie', [
            'movie' => $movie,
            'today' => $today
        ]);
    }

    public function adminMovie($id) 
    { 
        // 昇順でソート
        $movie = Movie::with(['genre', 'schedules' => function ($query) {
            $query->orderBy('start_time', 'asc');
        }])->findOrFail($id);

        return view('adminMovie', [
            'movie' => $movie
        ]);
    }
}