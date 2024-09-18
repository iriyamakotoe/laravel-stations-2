<?php
namespace App\Http\Controllers;
use App\Practice;
use App\Models\Genre;
use App\Models\Schedule;
class PracticeController extends Controller
{
    public function sample()
    {
        return view('practice');
    }

    public function sample2()
    {
        $test = 'practice2';
        return view('practice2', ['testParam' => $test]);
    }

    public function sample3()
    {
        $test = 'test';
        return view('practice2', ['testParam' => $test]);
    }

    public function getPractice()
    {
        $practice = Schedule::all();
        return response()->json($practice);
        // $practices = Genre::all();
        // return view('getPractice', ['practices' => $practices]);
    }
}