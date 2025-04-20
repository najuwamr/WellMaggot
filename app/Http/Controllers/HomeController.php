<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboardUser()
    {
        return view('dashboardUser'); // Pastikan kamu punya file resources/views/beranda.blade.php
    }
}
