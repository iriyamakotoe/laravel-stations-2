<?php
namespace App\Http\Controllers;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
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

        // $movies = Movie::all();
        return view('index', [
            'movies' => $movies,
            'keyword' => $keyword,
            'isShowing' => $isShowing
        ]);
    }
    public function admin()
    {
        $movies = Movie::all();
        return view('admin', ['movies' => $movies]);
    }
    public function createMovie()
    {
        return view('createMovie', []);
    }
    public function postMovie(Request $request) 
    { 
        $validated = $request->validate([
            'title' => 'required|unique:movies',
            'image_url' => 'required|active_url',
            'published_year' => 'required|numeric',
            'is_showing' => 'required',           
            'description' => 'required',           
        ]);
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
        $post->save();
        return redirect('/admin/movies');
     }
     public function editMovie($id)
     {
        $movies = Movie::where('id',$id)->first();
        return view('editMovie', ['movies' => $movies]);
     }
     public function patchMovie(Request $request, $id) 
     { 
         $validated = $request->validate([
             'title' => 'required',
             'image_url' => 'required|active_url',
             'published_year' => 'required|numeric',
             'is_showing' => 'required',           
             'description' => 'required',           
         ]);

         try {
            $is_showing = $request->is_showing;
            if($is_showing=="is_showing") {
                $is_showing = true;
            } elseif($is_showing=="not_showing") {
                $is_showing = false;
            }
            Movie::where("id", $id)->update([
               "title" => $request->title,
               "image_url" => $request->image_url,
               "published_year" => $request->published_year,
               "is_showing" => $is_showing,
               "description" => $request->description
           ]);
            return redirect('/admin/movies');
        } catch (QueryException $e) {
            // 重複エラーをキャッチして、エラーメッセージをフロントに表示
            if ($e->errorInfo[1] == 1062) { // MySQLの重複エラーコードは1062
                return redirect()->back()->withErrors(['title' => 'このタイトルは既に使用されています。']);
            }
            // 他の例外処理
            return redirect()->back()->withErrors(['error' => '何か問題が発生しました。']);
        }
      }
      public function deleteMovie($id) 
      { 
        $movie = Movie::findOrFail($id);

        // データが存在すれば削除
        $movie->delete();

        // 成功メッセージをフロントエンドに返す
        return redirect()->back()->with('success', '削除しました。');
       }
}