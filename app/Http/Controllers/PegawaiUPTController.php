<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiUPTController extends Controller
{
    public function index()
    {
        return view('upt.index');
    }

    public function create()
    {
        return view('upt.create');
    }

    public function edit()
    {
        return view('upt.edit');
    }
}
