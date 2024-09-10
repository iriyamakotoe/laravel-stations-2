<?php
namespace App\Http\Controllers;
use App\Models\Movie;
use Illuminate\Http\Request;
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
    //  public function editMovie()
    //  {
    //      return view('editMovie', []);
    //  }
}