<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PointController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role_id === 1) {
            return view('point-admin',);
        } else {
            return view('point-user',);
        }
    }

}
