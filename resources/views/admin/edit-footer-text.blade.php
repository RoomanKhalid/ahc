@extends('admin.app')
@section('title','Footer Section')
@section('header_title','Edit Footer Text')
@section('maincontent')
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Edit Footer Text</h3>
    </div>

    <!-- /.card-header -->
    <!-- form start -->

    <form class="form-horizontal" method="post" action="{{route('webadminfooter-section.update', [$text->id])}}"
        enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Prefix Line</label>
                <div class="col-sm-6">
                    <input type="text" name="prefix_line" class="form-control" id="prefix_line"
                        value="{{$text->prefix_line}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Postfix Words</label>
                <div class="col-sm-6">
                    <input type="text" name="postfix_words" class="form-control" id="postfix_words"
                        value="{{$text->postfix_words}}">
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Edit</button>
            <a class="btn btn-danger" href="{{url('webadmin/footer-section')}}">Cancel</a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->
@endsection