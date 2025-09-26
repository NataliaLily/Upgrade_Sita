<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        dd("Hello World");
        return view('dosen.dashboard');
    }
}
