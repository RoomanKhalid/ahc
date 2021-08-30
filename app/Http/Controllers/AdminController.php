<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    //
        // Edit Profile

    // public function editProfile()
    // {
    //     $id = Auth::guard('admin')->user()->id;
    //    $profile =  Admin::find($id);
    //     return view('admin.edit-profile', compact('profile'));
    // }
}