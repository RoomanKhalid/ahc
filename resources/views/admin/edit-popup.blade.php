@extends('admin.app')
@section('title','Popups Section')
@section('header_title','Edit Popup')
@section('maincontent')
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Edit Popup</h3>
    </div>

    <!-- /.card-header -->
    <!-- form start -->

    <form class="form-horizontal" method="post" action="{{route('webadminpopup.update', [$popup->id])}}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body">
            @if($errors->first('title'))
            <div class="alert alert-danger">
                {{$errors->first('title')}}
            </div>
            @endif
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Popup Title</label>
                <div class="col-sm-6">
                    <input type="text" name="title" class="form-control" id="title" value="{{$popup->title}}">
                </div>
            </div>
            @if($errors->first('image'))
            <div class="alert alert-danger">
                {{$errors->first('image')}}
            </div>
            @endif
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-6">
                    <input type="file" name="image" class="" id="image">
                    <img src="{{asset('storage/images/popups')}}/{{$popup->image}}" width="150">
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Update</button>
            <a class="btn btn-danger" href="{{url('webadmin/popup')}}">Cancel</a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->
@endsection