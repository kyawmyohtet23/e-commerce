<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    //

    public function showLogin()
    {
        return view('admin.login');
    }

    // admin login
    public function login(Request $request)
    {
        $validator = $this->validation($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cre = $this->getData($request);

        // dd($cre);

        $attemptAuth = auth()->guard('admin')->attempt($cre);

        if ($attemptAuth) {

            return redirect()->route('adminDashboard')->with('success', 'Welcome ' . auth()->guard('admin')->user()->name);
        } else {


            return redirect()->back()->with('error', 'Email and Password do not match');
        }
    }

    // logout
    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('adminLoginPage');
    }


    // dashboard
    public function showDashboard()
    {
        return view('admin.dashboard');
    }


    private function validation($request)
    {
        return Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email required.',
            'email.email' => 'Please fill your gmail',
            'password' => 'Password.required.',
        ]);
    }

    private function getData($request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password,
        ];
    }
}
