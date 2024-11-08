<?php
namespace App\Http\Controllers;
use App\Models\Sheet;
class SheetController extends Controller
{
    public function sheets() 
    { 
         $sheets = Sheet::all();
 
         return view('sheets', [
            'sheets' => $sheets
        ]);
    }
}