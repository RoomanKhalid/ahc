@extends('admin.app')
@section('title','Schedule Section')
@section('header_title','Edit Schedule')
@section('maincontent')
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Edit Schedule</h3>
    </div>

    <!-- /.card-header -->
    <!-- form start -->

    <form class="form-horizontal" method="post" action="{{route('webadminschedule.update', [$schedule->id])}}"
        enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body">
            <div class="form-group row">
                <label for="doctorid" class="col-sm-2 col-form-label">Doctor Name</label>
                <div class="col-sm-6">
                    <select class="form-control select2" name="doctor_id" required>
                        <option disabled selected hidden>Select Doctor</option>
                        @if($doctors->count() > 0)
                        @foreach($doctors as $doctor)
                        <option class="mt-5 p-5" value="{{$doctor->id}}" @if($doctor->id == $schedule->doctor_id) selected @endif>{{$doctor->doctor_name}}</option>
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
                        <option class="mt-5 p-5" value="date" @if($schedule->schedule_by == "date") selected @endif>By Date</option>
                        <option class="mt-5 p-5" value="day" @if($schedule->schedule_by == "day") selected @endif>By Day</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mt-5 byDate" style="display:none;">
                <label for="show_untill_date" class="col-sm-2 col-form-label">Date</label>
                <div class="input-group date col-sm-6 reservationdate" id="" data-target-input="nearest">
                    <input type="text" name="date" class="form-control datetimepicker-input" data-target=".reservationdate" placeholder="Select Date" value="{{$schedule->date}}" />
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
                        <option class="mt-5 p-5" value="monday" @if($schedule->day == "monday") selected @endif>Monday</option>
                        <option class="mt-5 p-5" value="tuesday" @if($schedule->day == "tuesday") selected @endif>Tuesday</option>
                        <option class="mt-5 p-5" value="wednesday" @if($schedule->day == "wednesday") selected @endif>Wednesday</option>
                        <option class="mt-5 p-5" value="thursday" @if($schedule->day == "thursday") selected @endif>Thursday</option>
                        <option class="mt-5 p-5" value="friday" @if($schedule->day == "friday") selected @endif>Friday</option>
                        <option class="mt-5 p-5" value="saturday" @if($schedule->day == "saturday") selected @endif>Saturday</option>
                    </select>
                </div>
            </div>

            @error('day')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="bootstrap-timepicker">
                <div class="form-group row">
                    <label class="col-sm-2" >Start Time:</label>
                    <div class=" col-sm-6 input-group date" id="timepicker" data-target-input="nearest">
                        <input type="text" name="start_time" class="form-control datetimepicker-input" data-target="#timepicker" value="{{$schedule->start_time}}" required/>
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
                        <input type="text" name="end_time" class="form-control datetimepicker-input" data-target="#timepicker1" value="{{$schedule->end_time}}"  required/>
                        <div class="input-group-append" data-target="#timepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            @error('end_time')<div class="alert alert-danger">{{$message}}</div>@enderror

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Update</button>
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