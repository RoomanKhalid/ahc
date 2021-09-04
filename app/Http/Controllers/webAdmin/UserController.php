<?php

namespace App\Http\Controllers\webAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Nationalities;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('nationality')->whereHas('nationality')->get();
        // return $users;
        return view('admin.view-users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nationalities = Nationalities::get();
        return view('admin.add-user',compact('nationalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'profile_image' => 'required|mimes:jpg,jpeg,png',
            'number' => 'required',
            'address' => 'required',
            'nationality_id' => 'required',
            'education' => 'required',
            'role' => 'required',
            'password' => 'required',
            ]);

            $errors = $validator->errors();

            if($validator->fails()) 
            {
              return redirect()->back()->withErrors($errors);
            }
            else
            {
                if($request->hasFile('profile_image')) {
                    $fileNameWithExt = $request->file('profile_image')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('profile_image')->getClientOriginalExtension();
                    $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                    $path = $request->file('profile_image')->storeAs('public/images/users', $fileNameToStore);
                }
                
                $users = new User();

                $users->name = $request->name;
                $users->email = $request->email;
                $users->profile_image = $fileNameToStore;
                $users->number = $request->number;
                $users->address = $request->address;
                $users->nationality_id = $request->nationality_id;
                $users->education = $request->education;
                $users->role = $request->role;
                $users->password = Hash::make($request->password);
                $users->save(); 
                return redirect()->route('webadminusers.index')->with('user_added', 'User added successfully.'); 
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $nationalities = Nationalities::get();
        return view('admin.edit-user', compact('user', 'nationalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'number' => 'required',
            'address' => 'required',
            'nationality_id' => 'required',
            'education' => 'required',
            'role' => 'required',
            ]);

            $errors = $validator->errors();

            $users = User::find($id);

            if($validator->fails()) 
            {
              return redirect()->back()->withErrors($errors);
            }
            else
            {
                if($request->hasFile('profile_image')) {
                    $fileNameWithExt = $request->file('profile_image')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('profile_image')->getClientOriginalExtension();
                    $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                    $path = $request->file('profile_image')->storeAs('public/images/users', $fileNameToStore);
                }
                else{
                    $fileNameToStore = $users->profile_image;
                }

                if($request->password)
                {
                    $users->password = Hash::make($request->password);
                }

                $users->name = $request->name;
                $users->email = $request->email;
                $users->number = $request->number;
                $users->address = $request->address;
                $users->nationality_id = $request->nationality_id;
                $users->education = $request->education;
                $users->role = $request->role;
                $users->save(); 
                return redirect()->route('webadminusers.index')->with('user_updated', 'User updated successfully.'); 
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('webadminusers.index')->with('user_deleted', 'User deleted successfully.');
    }
}