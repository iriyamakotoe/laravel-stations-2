<?php
namespace App\Http\Controllers;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('index', ['movies' => $movies]);
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
}