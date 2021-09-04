@extends('admin.app')
@section('title','Users Section')
@section('header_title','Edit User')
@section('maincontent')
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Edit User</h3>
    </div>

    <!-- /.card-header -->
    <!-- form start -->

    <form class="form-horizontal" method="post" action="{{route('webadminusers.update', [$user->id])}}"
        enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body">

            @error('name')
            <div class="alert alert-danger">
                {{$message}}
            </div>
            @enderror
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
                </div>
            </div>

            @error('email')
            <div class="alert alert-danger">
                {{$message}}
            </div>
            @enderror
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}">
                </div>
            </div>

            @error('number')
            <div class="alert alert-danger">
                {{$message}}
            </div>
            @enderror
            <div class="form-group row">
                <label for="number" class="col-sm-2 col-form-label">Number</label>
                <div class="col-sm-6">
                    <input type="number" name="number" class="form-control" id="number" value="{{$user->number}}">
                </div>
            </div>

            @error('address')
            <div class="alert alert-danger">
                {{$message}}
            </div>
            @enderror
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" name="address" class="form-control" id="address" value="{{$user->address}}">
                </div>
            </div>

            @error('nationality_id')
            <div class="alert alert-danger">
                {{$message}}
            </div>
            @enderror
            <div class="form-group row mt-5">
                <label for="type" class="col-sm-2 col-form-label">Nationality</label>
                <div class="col-sm-6">
                    <select class="select2 form-control" name="nationality_id">
                        <option disabled selected hidden>-- Select Nationality --</option>
                        @if($nationalities->count() > 0)
                        @foreach($nationalities as $nationality)
                        <option class="mt-5 p-5" value="{{$nationality->id}}" @if($nationality->id ==
                            $user->nationality_id) selected @endif>{{$nationality->country_name}}</option>
                        @endforeach
                        @else
                        <option class="mt-5 p-5">No Nationality found!</option>
                        @endif
                    </select>
                </div>
            </div>

            @error('education')
            <div class="alert alert-danger">
                {{$message}}
            </div>
            @enderror
            <div class="form-group row">
                <label for="education" class="col-sm-2 col-form-label">Education</label>
                <div class="col-sm-6">
                    <input type="text" name="education" class="form-control" id="education"
                        value="{{$user->education}}">
                </div>
            </div>

            @error('role')
            <div class="alert alert-danger">
                {{$message}}
            </div>
            @enderror
            <div class="form-group row mt-5">
                <label for="type" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-6">
                    <select class="select2 form-control" name="role">
                        <option disabled selected hidden>-- Select Role --</option>
                        <option class="mt-5 p-5" value="doctor" @if($user->role == "doctor") ? selected : ''
                            @endif>Doctor</option>
                        <option class="mt-5 p-5" value="receptionist" @if($user->role == "receptionist") ? selected : ''
                            @endif>Receptionist</option>
                        <option class="mt-5 p-5" value="inventory" @if($user->role == "inventory") ? selected : ''
                            @endif>Inventory</option>
                        <option class="mt-5 p-5" value="accounts" @if($user->role == "accounts") ? selected : ''
                            @endif>Accounts</option>
                        <option class="mt-5 p-5" value="nurse" @if($user->role == "nurse") ? selected : ''
                            @endif>Nurse</option>
                        <option class="mt-5 p-5" value="optometris" @if($user->role == "optometris") ? selected : ''
                            @endif>Optometris</option>
                        <option class="mt-5 p-5" value="patient" @if($user->role == "patient") ? selected : ''
                            @endif>Patient</option>
                    </select>
                </div>
            </div>


            @error('password')
            <div class="alert alert-danger">
                {{$message}}
            </div>
            @enderror
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" name="password" class="form-control" id="password">
                </div>
            </div>

            @error('profile_image')
            <div class="alert alert-danger">
                {{$message}}
            </div>
            @enderror
            <div class="form-group row">
                <label for="profile_image" class="col-sm-2 col-form-label">Profile Image</label>
                <div class="col-sm-6">
                    <input type="file" name="profile_image" class="form-control-file" id="profile_image">
                    <img class="mt-2" src="{{asset('storage/images/users')}}/{{$user->profile_image}}" width="150"
                        alt="">
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Edit</button>
            <a class="btn btn-danger" href="{{url('webadmin/users')}}">Cancel</a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->
@endsection