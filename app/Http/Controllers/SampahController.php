<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampahController extends Controller
{
    public function index()
    {
        return view('bagi-sampah');
    }
}
