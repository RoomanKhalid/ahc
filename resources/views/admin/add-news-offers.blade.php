@extends('admin.app')
@section('title','News & Offers')
@section('header_title','Add News & Offers')
@section('maincontent')
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Add News & Offers</h3>
    </div>

    <!-- /.card-header -->
    <!-- form start -->

    <form class="form-horizontal" method="post" action="{{route('webadminnews-offers.store')}}"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            @if($errors->first('title'))
            <div class="alert alert-danger">
                {{$errors->first('title')}}
            </div>
            @endif
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-6">
                    <input type="text" name="title" class="form-control" id="title">
                </div>
            </div>

            @if($errors->first('description'))
            <div class="alert alert-danger">
                {{$errors->first('description')}}
            </div>
            @endif
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-6">
                    <textarea id="summernote" name="description" rows="100"></textarea>
                </div>
            </div>

            @if($errors->first('image'))
            <div class="alert alert-danger">
                {{$errors->first('image')}}
            </div>
            @endif
            <div class="form-group row mt-5">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-6">
                    <input type="file" name="image" class="form-control-file" />
                </div>
            </div>

            @if($errors->first('type'))
            <div class="alert alert-danger">
                {{$errors->first('type')}}
            </div>
            @endif
            <div class="form-group row mt-5">
                <label for="type" class="col-sm-2 col-form-label">Select type</label>
                <div class="col-sm-6">
                    <select class="select2 form-control" name="type">
                        <option disabled selected hidden>-- Select type --</option>
                        <option class="mt-5 p-5" value="news">News</option>
                        <option class="mt-5 p-5" value="offer">Offer</option>
                    </select>
                </div>
            </div>

            @if($errors->first('show_untill_date'))
            <div class="alert alert-danger">
                {{$errors->first('show_untill_date')}}
            </div>
            @endif
            <div class="form-group row mt-5">
                <label for="show_untill_date" class="col-sm-2 col-form-label">Date</label>
                <div class="input-group date col-sm-6 reservationdate" id="" data-target-input="nearest">
                    <input type="text" name="show_untill_date" class="form-control datetimepicker-input"
                        data-target=".reservationdate" placeholder="Select Date" />
                    <div class="input-group-append" data-target=".reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>



        </div> <!-- //card bode end -->

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Add</button>
            <a class="btn btn-danger" href="{{route('webadminnews-offers.index')}}">Cancel</a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->
@endsection