<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('auth.login');
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'username' => [
                    'required',
                    'max:255',
                    function ($attribute, $value, $fail) {
                        if (!($value === config('constants.login_username'))) {
                            $fail($attribute.' is invalid.');
                        }
                    },
                ],
                'password' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (!($value === config('constants.login_password'))) {
                            $fail($attribute.' is invalid.');
                        }
                    },
                ]
            ]);

            if ($validator->fails())
            {
                if ($request->ajax()) {
                    return response()->json(['errors'=>$validator->errors()], 401);
                }
                return redirect()->back()->withErrors($validator->errors());
            } else {
                $request->session()->put('username', $request->input('username'));
                if ($request->ajax()) {
                    return 'Login Successfuly!';
                }
                return redirect('/products');
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('username');

        if ($request->ajax()) {
            return 'Logout Successfuly!';
        }

        return redirect('/login');
    }
}
