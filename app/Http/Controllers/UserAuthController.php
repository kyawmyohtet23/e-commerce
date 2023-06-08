<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    //
    public function index()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validator = $this->validation($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Success! Please Log In');
    }



    public function loginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $validator = $this->validation($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token']);


        $attemptAuth = auth()->guard('web')->attempt($data);

        // dd($attemptAuth);

        if ($attemptAuth) {
            return redirect()->route('home')->with('success', 'Welcome ' . auth()->guard('web')->user()->name);
        } else {
            return redirect()->back()->with('error', 'Email and Password do not match');
        }
    }



    public function logout()
    {
        auth()->guard('web')->logout();
        return redirect()->route('home')->with('success', 'Your account has logout');
    }


    private function validation($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email',
        ], []);
    }
}
