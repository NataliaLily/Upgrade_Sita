<?php

namespace App\Http\Controllers;

use App\Models\Pendadaran;
use Illuminate\Http\Request;

class PendadaranController extends Controller
{


    public function index(Request $request)
    {
        return view('admin.pendadaran.index');
    }
}
