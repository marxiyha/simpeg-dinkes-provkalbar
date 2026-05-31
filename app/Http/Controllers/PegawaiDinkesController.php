
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiDinkesController extends Controller
{
    public function index()
    {
        return view('dinkes.index');
    }

    public function create()
    {
        return view('dinkes.create');
    }

    public function edit()
    {
        return view('dinkes.edit');
    }
}
