@extends('admin.app')
@section('title','Doctors Section')
@section('header_title','View Doctors')
@section('maincontent')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">View Doctors</h3>
        <a href="{{url('webadmin/doctor/create')}}" class=" btn btn-primary card-title float-right">Add Doctor</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr. #</th>
                    <th>Doctor Name</th>
                    <th>Clinic Name</th>
                    <th>Designation</th>
                    <th>Appointment Duration</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1
                @endphp
                @foreach($doctors as $key => $doctor)
                <tr>
                    <th class="text-right align-middle">{{$key+1}}</th>
                    <td class=" align-middle">{{$doctor->doctor_name}}</td>
                    <td class=" align-middle">{{$doctor->clinic->clinic_name}}</td>
                    <td class=" align-middle">{{$doctor->designation}}</td>
                    <td class=" align-middle">{{$doctor->appointment_duration}}</td>
                    <!-- <td class="text-center align-middle"><img class="rounded" src="{{asset('storage/images/doctors')}}/{{$doctor->image}}" height="70"
                            width="70" alt="doctor_image">
                    </td> -->
                    @php
                    $i++;
                    @endphp
                    <td class="text-center align-middle">
                        @if($doctor->status == 0)
                        <button
                            class="pushy__btn pushy__btn--sm pushy__btn--red change_status_btn enable_disable_doctor"
                            id="{{$doctor->id}}">Disabled</button>
                        @else
                        <button
                            class="pushy__btn pushy__btn--sm pushy__btn--green change_status_btn enable_disable_doctor"
                            id="{{$doctor->id}}">Enabled</button>
                        @endif
                    </td>
                    <td class=" text-center align-middle">
                        <a href="{{ route('webadmindoctor.edit', $doctor->id) }}">
                            <i class="fas fa-edit text-primary"></i>
                        </a>
                        <a href="javascript:void(0);" class="delBtn" id="delBtn"><i
                                class="fa fa-trash text-danger"></i></a>
                        <form id="formDel" action="{{ route('webadmindoctor.destroy',$doctor->id) }}" method="post"
                            id="delete-{{$key}}"> @csrf @method('delete') </form>
                    </td>
                    @endforeach
                </tr>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@endsection

@section('script')

@if(Session::has('doctor_added'))
<script>
toastr.success("{!! Session::get('doctor_added') !!}");
</script>
@endif



@if(Session::has('doctor_updated'))
<script>
toastr.success("{!! Session::get('doctor_updated') !!}");
</script>
@endif

<script>
$(document).ready(function() {
    $('.delBtn').click(function(e) {
        e.preventDefault();
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#formDel').submit();
                    swal("Poof! Your record has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your record is safe!", {
                        icon: "success",
                    });
                }
            });
    });
});
</script>

<script>
$(document).ready(function() {
    $(document).on('click', '.enable_disable_doctor', function() {
        const thisRef = $(this);
        thisRef.text('Processing');
        $.ajax({
            type: 'GET',
            url: 'doctor/change-status/' + thisRef.attr('id'),
            success: function(response) {
                console.log(response);
                if (response.status == 1) {
                    toastr.success(response.msg);

                    thisRef.text(response.text);
                    thisRef.removeClass(response.removeClass);
                    thisRef.addClass(response.class);

                } else {
                    toastr.success(response.msg);
                }
            }
        });
    });
});
</script>

@endsection