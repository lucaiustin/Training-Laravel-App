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
                return redirect()->back()->withErrors($validator->errors());
            } else {
                $request->session()->put('username', $request->input('username'));
                return redirect('/products');
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('username');
        return redirect('/login');
    }
}
