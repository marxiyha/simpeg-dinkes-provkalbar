
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaturanSistemController extends Controller
{
    public function index()
    {
        return view('pengaturan.index');
    }
}
