<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function check(Request $request){
        $check = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($check){

            $credentials = $request->only('email', 'password');
            // dd($credentials);
            // dd(Auth::attempt($credentials));

            if(Auth::guard('web')->attempt($credentials)){

                $request->session()->regenerate();
                return redirect()->route('admin.home');
            }else{
                // toast('Incorrect Credentials','error');
                return redirect()->route('admin.login');
            }
        }
    }

    public function logout(Request $request){
        // dd($request);
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
