@extends('admin.app')
@section('title','Footer Section')
@section('header_title','Add Footer Text')
@section('maincontent')
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Add Footer Text</h3>
    </div>

    <!-- /.card-header -->
    <!-- form start -->

    <form class="form-horizontal" method="post" action="{{route('webadminfooter-section.store')}}"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            @if($errors->first('prefix_line'))
            <div class="alert alert-danger">
                {{$errors->first('prefix_line')}}
            </div>
            @endif
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Prefix Line</label>
                <div class="col-sm-6">
                    <input type="text" name="prefix_line" class="form-control" id="prefix_line">
                </div>
            </div>
            @if($errors->first('postfix_words'))
            <div class="alert alert-danger">
                {{$errors->first('postfix_words')}}
            </div>
            @endif
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Postfix Words</label>
                <div class="col-sm-6">
                    <input type="text" name="postfix_words" class="form-control" id="postfix_words">
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Add</button>
            <a class="btn btn-danger" href="{{url('webadmin/footer-section')}}">Cancel</a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->
@endsection