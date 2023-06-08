<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    //
    public function changePassword(Request $request)
    {

        // $validation = $this->validation($request);
        // if ($validation->fails()) {
        //     return redirect()->back()->withErrors($validation)->withInput();
        // }

        $user = auth()->user();
        $data = Hash::check($request->currentPassword, $user->password);

        if ($request->newPassword == '') {
            return 'new_password_required';
        }
        if ($request->currentPassword == '') {
            return 'current_required';
        }

        if ($data && $request->newPassword != '' && $request->currentPassword != '') {
            User::where('id', $user->id)->update([
                'password' => Hash::make($request->newPassword),
            ]);

            return 'success';
        }
        return 'wrong_password';


        // if (!$data) {
        //     return 'wrong_password';
        // }
    }

    // private function validation($request)
    // {
    //     return Validator::make($request->all(), [
    //         'password' => 'required',
    //     ], [
    //         'password.required' => 'Current Password required',
    //     ]);
    // }
}
