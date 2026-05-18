
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportDataController extends Controller
{
    public function index()
    {
        return view('export.index');
    }
}
