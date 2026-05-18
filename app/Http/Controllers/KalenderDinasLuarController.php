
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KalenderDinasLuarController extends Controller
{
    public function index()
    {
        return view('kalender.index');
    }
}
