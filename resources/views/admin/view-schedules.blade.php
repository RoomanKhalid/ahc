@extends('admin.app')
@section('title','Schedules Section')
@section('header_title','View Schedules')
@section('maincontent')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">View Schedules</h3>
        <a href="{{url('webadmin/schedule/create')}}" class=" btn btn-primary card-title float-right">Add Schedule</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr. #</th>
                    <th>Doctor Name</th>
                    <th>Scheduled By</th>
                    <th>Date / Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1
                @endphp
                @foreach($schedules as $key => $schedule)
                <tr>
                    <th class="text-right align-middle">{{$key+1}}</th>
                    <td class=" align-middle">{{$schedule->doctor->doctor_name}}</td>
                    <td class=" align-middle">{{$schedule->schedule_by}}</td>
                    <td class=" align-middle">{{$schedule->schedule_by ==  'day' ? $schedule->day : $schedule->date}}</td>
                    <td class=" align-middle">{{$schedule->start_time}}</td>
                    <td class=" align-middle">{{$schedule->end_time}}</td>
                    <!-- <td class="text-center align-middle"><img class="rounded"
                            src="{{asset('storage/images/schedules')}}/{{$schedule->image}}" height="70" width="70"
                            alt="schedule_image">
                    </td> -->
                    @php
                    $i++;
                    @endphp
                    <td class="text-center align-middle">
                        @if($schedule->status == 0)
                        <button
                            class="pushy__btn pushy__btn--sm pushy__btn--red change_status_btn enable_disable_schedule"
                            id="{{$schedule->id}}">Disabled</button>
                        @else
                        <button
                            class="pushy__btn pushy__btn--sm pushy__btn--green change_status_btn enable_disable_schedule"
                            id="{{$schedule->id}}">Enabled</button>
                        @endif
                    </td>
                    <td class=" text-center align-middle">
                        <a href="{{ route('webadminschedule.edit', $schedule->id) }}">
                            <i class="fas fa-edit text-primary"></i>
                        </a>
                        <a href="javascript:void(0);" class="delBtn" id="delBtn"><i
                                class="fa fa-trash text-danger"></i></a>
                        <form id="formDel" action="{{ route('webadminschedule.destroy',$schedule->id) }}" method="post"
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

@if(Session::has('schedule_added'))
<script>
toastr.success("{!! Session::get('schedule_added') !!}");
</script>
@endif

@if(Session::has('schedule_updated'))
<script>
toastr.success("{!! Session::get('schedule_updated') !!}");
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
                    e.preventDefault();
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
    $(document).on('click', '.enable_disable_schedule', function() {
        const thisRef = $(this);
        thisRef.text('Processing');
        $.ajax({
            type: 'GET',
            url: 'schedule/change-status/' + thisRef.attr('id'),
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