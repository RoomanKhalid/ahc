@extends('admin.app')
@section('title','Doctors Section')
@section('header_title','Add Doctor')
@section('maincontent')
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Add Doctor</h3>
    </div>

    <!-- /.card-header -->
    <!-- form start -->

    <form class="form-horizontal" method="post" action="{{route('webadmindoctor.store')}}"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="clinicid" class="col-sm-2 col-form-label">Clinic Name</label>
                <div class="col-sm-6">
                    <select class="form-control select2" name="clinic_id" required>
                        <option disabled selected hidden>Select Clinic</option>
                        @if($clinics->count() > 0)
                        @foreach($clinics as $clinic)
                        <option class="mt-5 p-5" value="{{$clinic->id}}">{{$clinic->clinic_name}}</option>
                        @endforeach
                        @else
                        <option>No Clinics Found</option>
                        @endif
                    </select>
                </div>
            </div>

            @error('clinic_id')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Doctor Name</label>
                <div class="col-sm-6">
                    <input type="text" name="doctor_name" class="form-control" value="{{ old('doctor_name') }}" required>
                </div>
            </div>

            @error('doctor_name')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Short Description</label>
                <div class="col-sm-6">
                    <input type="text" name="short_description" class="form-control" value="{{ old('short_description') }}" required>
                </div>
            </div>

            @error('short_description')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                </div>
            </div>

            @error('description')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Appointment Duration</label>
                <div class="col-sm-6">
                    <input type="text" name="appointment_duration" class="form-control" value="{{ old('appointment_duration') }}" required>
                </div>
            </div>

            @error('appointment_duration')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Mobile No</label>
                <div class="col-sm-6">
                    <input type="number" name="mobile_no" class="form-control" value="{{ old('mobile_no') }}" required>
                </div>
            </div>

            @error('mobile_no')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Designation</label>
                <div class="col-sm-6">
                    <input type="text" name="designation" class="form-control" value="{{ old('designation') }}" required>
                </div>
            </div>

            @error('designation')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row mt-5">
                <label for="joining_date" class="col-sm-2 col-form-label">Joining Date</label>
                <div class="input-group date col-sm-6 reservationdate" id="" data-target-input="nearest">
                    <input type="text" name="joining_date" class="form-control datetimepicker-input"
                        data-target=".reservationdate" placeholder="Select Joining Date" />
                    <div class="input-group-append" data-target=".reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>

            @error('joining_date')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-6">
                    <select class="form-control select2" name="status" required>
                        <option disabled selected hidden>Select Doctor Status</option>
                        <option class="mt-5 p-5" value="Permanent">Permanent</option>
                        <option class="mt-5 p-5" value="Omani Visiting Consultant">Omani Visiting Consultant</option>
                        <option class="mt-5 p-5" value="Al-Nahda Visiting Consultant">Al-Nahda Visiting Consultant</option>
                        <option class="mt-5 p-5" value="Indian Visiting Consultant">Indian Visiting Consultant</option>
                    </select>
                </div>
            </div>

            @error('status')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-6">
                    <input type="text" name="type" class="form-control" value="{{ old('type') }}" required>
                </div>
            </div>

            @error('type')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row">
                <label for="center" class="col-sm-2 col-form-label">Center</label>
                <div class="col-sm-6">
                    <select class="form-control select2" name="center" required>
                        <option disabled selected hidden>Select Center</option>
                        <option class="mt-5 p-5" value="MSQ">MSQ</option>
                    </select>
                </div>
            </div>

            @error('center')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Expense</label>
                <div class="col-sm-6">
                    <input type="dobule" name="expense" class="form-control" value="{{ old('expense') }}" required>
                </div>
            </div>

            @error('expense')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Bank Charges</label>
                <div class="col-sm-6">
                    <input type="dobule" name="bank_charges" class="form-control" value="{{ old('bank_charges') }}" required>
                </div>
            </div>

            @error('bank_charges')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Ayann Percentage</label>
                <div class="col-sm-6">
                    <input type="dobule" name="ayaan_percent" class="form-control" value="{{ old('ayaan_percent') }}" required>
                </div>
            </div>

            @error('ayaan_percent')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Doctor Percentage</label>
                <div class="col-sm-6">
                    <input type="dobule" name="doctor_percent" class="form-control" value="{{ old('doctor_percent') }}" required>
                </div>
            </div>

            @error('doctor_percent')<div class="alert alert-danger">{{$message}}</div>@enderror

            <div class="form-group row mt-5">
                <label for="image" class="col-sm-2 col-form-label">Profile Image</label>
                <div class="col-sm-6">
                    <input type="file" name="doctor_profile_image" class="" required />
                </div>
            </div>

            @error('doctor_profile_image')<div class="alert alert-danger">{{$message}}</div>@enderror

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Add</button>
            <a class="btn btn-danger" href="{{url('webadmin/doctor')}}">Cancel</a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->
@endsection