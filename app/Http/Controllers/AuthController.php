<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('v_login');
    }

    public function prosesLogin(Request $request)
    {
        if (Auth::guard('user')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]));

        return redirect('/');
    }

    function prosesLogout()
    {
        if (Auth::guard('user')->check()) {
            (Auth::guard('user')->logout());
            return redirect('/login');
        }
        return response()->json(['success' => 'Success']);
    }
}
