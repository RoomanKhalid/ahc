<?php

namespace App\Http\Controllers\webAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{

    public function hello() {
        return "done";
    }
   
    public function customLogin(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        // return \Hash::make(123456789);
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('webadmin/dashboard');
        }
        else{
            return redirect("webadmin/login")->with('message', 'Login details are not valid!');
        }   
    }



    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('webadmin/login');
    }
}
