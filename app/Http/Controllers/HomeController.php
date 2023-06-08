<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // home page
    public function home()
    {
        return view('home');
    }

    public function switchLanguage($lang)
    {
        session()->put('lang', $lang);
        // return session('lang');
        return redirect()->back();
    }
}
