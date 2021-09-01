@extends('admin.app')
@section('title','Banners Section')
@section('header_title','Add Banner')
@section('maincontent')
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Add Banner</h3>
    </div>

    <!-- /.card-header -->
    <!-- form start -->

    <form class="form-horizontal" method="post" action="{{route('webadminbanner.store')}}"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            @error('name')
            <div class="alert alert-danger">
                {{$message}}
            </div>
            @enderror
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Banner Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                </div>
            </div>

            @error('image')
            <div class="alert alert-danger">
                {{$message}}
            </div>
            @enderror

            <div class="form-group row mt-5">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-6">
                    <input type="file" name="image" class="" required />
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Add</button>
            <a class="btn btn-danger" href="{{url('webadmin/banner')}}">Cancel</a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->
@endsection