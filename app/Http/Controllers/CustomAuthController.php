<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
   
    public function customLogin(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        // return \Hash::make(123456789);
        if (Auth::guard('admin')->attempt($credentials)) {
        //    return auth()->guard('admin')->user();
            return redirect()->intended('admin/dashboard');
        }
        else{
            return redirect("login")->with('message', 'Login details are not valid!');
        }   
    }



    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('admin/login');
    }
}