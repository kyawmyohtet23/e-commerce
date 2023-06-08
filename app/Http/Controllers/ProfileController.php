<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function dashboard()
    {
        $user = auth()->user();
        return view('user.dashboard', compact('user'));
    }
}
