@extends('admin.app')
@section('title','Schedule Section')
@section('header_title','Add Schedule')
@section('maincontent')
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Add Schedule</h3>
    </div>

    <!-- /.card-header -->
    <!-- form start -->

    <form class="form-horizontal" method="post" action="{{route('webadminschedule.store')}}"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="doctorid" class="col-sm-2 col-form-label">Doctor Name</label>
                <div class="col-sm-6">
                    <select class="form-control select2" name="doctor_id" required>
                        <option disabled selected hidden>Select Doctor</option>
                        @if($doctors->count() > 0)
                        @foreach($doctors as $doctor)
                        <option class="mt-5 p-5" value="{{$doctor->id}}" {{ old('doctor_id') == $doctor->id ? "selected" : "" }}>{{$doctor->doctor_name}}</option>
                        @endforeach
                        @else
                        <option>No Doctors Found</option>
                        @endif
                    </select>
                </div>
            </div>

            @error('doctor_id')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row">
                <label for="doctorid" class="col-sm-2 col-form-label">Schedule By</label>
                <div class="col-sm-6">
                    <select class="form-control select2 scheduleBy" name="schedule_by" required>
                        <option disabled selected hidden>Add Schedule By</option>
                        <option class="mt-5 p-5" value="date" {{ old('schedule_by') == "date" ? "selected" : "" }}>By Date</option>
                        <option class="mt-5 p-5" value="day" {{ old('schedule_by') == "day" ? "selected" : "" }}>By Day</option>
                    </select>
                </div>
            </div>

            @error('schedule_by')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row mt-5 byDate" style="display:none;">
                <label for="show_untill_date" class="col-sm-2 col-form-label">Date</label>
                <div class="input-group date col-sm-6 reservationdate" id="" data-target-input="nearest">
                    <input type="text" name="date" class="form-control datetimepicker-input" data-target=".reservationdate" placeholder="Select Date" value="{{old('date')}}" />
                    <div class="input-group-append" data-target=".reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>

            @error('date_range')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row byDay" style="display:none;">
                <label for="doctorid" class="col-sm-2 col-form-label">Day</label>
                <div class="col-sm-6">
                    <select class="form-control select2" name="day">
                        <option disabled selected hidden>Select Day</option>
                        <option class="mt-5 p-5" value="monday" {{ old('day') == "monday" ? "selected" : "" }}>Monday</option>
                        <option class="mt-5 p-5" value="tuesday" {{ old('day') == "tuesday" ? "selected" : "" }}>Tuesday</option>
                        <option class="mt-5 p-5" value="wednesday" {{ old('day') == "wednesday" ? "selected" : "" }}>Wednesday</option>
                        <option class="mt-5 p-5" value="thursday" {{ old('day') == "thursday" ? "selected" : "" }}>Thursday</option>
                        <option class="mt-5 p-5" value="friday" {{ old('day') == "friday" ? "selected" : "" }}>Friday</option>
                        <option class="mt-5 p-5" value="saturday" {{ old('day') == "saturday" ? "selected" : "" }}>Saturday</option>
                    </select>
                </div>
            </div>

            @error('day')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="bootstrap-timepicker">
                <div class="form-group row">
                    <label class="col-sm-2" >Start Time:</label>
                    <div class=" col-sm-6 input-group date" id="timepicker" data-target-input="nearest">
                        <input type="text" name="start_time" class="form-control datetimepicker-input" data-target="#timepicker" value="{{old('start_time')}}" required/>
                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            @error('start_time')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="bootstrap-timepicker">
                <div class="form-group row">
                    <label class="col-sm-2" >End Time:</label>
                    <div class=" col-sm-6 input-group date" id="timepicker1" data-target-input="nearest">
                        <input type="text" name="end_time" class="form-control datetimepicker-input" data-target="#timepicker1" value="{{old('end_time')}}" required/>
                        <div class="input-group-append" data-target="#timepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            @error('end_time')<div class="alert alert-danger">{{$message}}</div>@enderror

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Add</button>
            <a class="btn btn-danger" href="{{url('webadmin/schedule')}}">Cancel</a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->
@endsection

@section('script')

<script>
    var sc = $('.scheduleBy').val();
        if(sc == 'day') {
            $('.byDate').hide();
            $('.byDay').show();
        }
        else{
            $('.byDay').hide();
            $('.byDate').show();
        }
    $('.scheduleBy').change(function () {
        var sc = $('.scheduleBy').val();
        if(sc == 'day') {
            $('.byDate').hide();
            $('.byDay').show();
        }
        else{
            $('.byDay').hide();
            $('.byDate').show();
        }
    });
</script>

@endsection