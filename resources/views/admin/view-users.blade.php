@extends('admin.app')
@section('title','Users Section')
@section('header_title','View Users')
@section('maincontent')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">View Users</h3>
        <a href="{{url('webadmin/users/create')}}" class=" btn btn-primary card-title float-right">Add User</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 2%">Sr. #</th>
                    <th>name</th>
                    <!-- <th>email</th> -->
                    <th>profile_image</th>
                    <th>number</th>
                    <!-- <th>address</th> -->
                    <th>Nationality</th>
                    <!-- <th>education</th> -->
                    <th>role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1
                @endphp
                @foreach($users as $key => $user)
                <tr>
                    <th class="text-right align-middle">{{$key+1}}</th>
                    <td class=" align-middle">{{$user->name}}</td>
<<<<<<< HEAD
                    <!-- <td class=" align-middle">{{$user->email}}</td> -->
                    <td class="text-center align-middle"><img class="rounded"
                            src="{{asset('storage/images/users')}}/{{$user->profile_image}}" height="70" width="70"
                            alt="Profile Image">
=======
                    <td class=" align-middle">{{$user->email}}</td>
                    <td class="text-center align-middle">
                        <img src="{{$user->profile_image}}" class="rounded" height="70" width="70" alt="">
>>>>>>> 96dc0d187c36a5afe15f830cc4c892948ab71ef0
                    </td>
                    <td class=" align-middle">{{$user->number}}</td>
                    <!-- <td class=" align-middle">{{$user->address}}</td> -->
                    <td class=" align-middle">{{$user->nationality->country_name}}</td>
                    <!-- <td class=" align-middle">{{$user->education}}</td> -->
                    <td class=" align-middle">{{$user->role}}</td>

                    <td class=" text-center align-middle">
                        <a href="{{ route('webadminusers.edit', $user->id) }}">
                            <i class="fas fa-edit text-primary"></i>
                        </a>
                        <a href="javascript:void(0);" class="delBtn" id="delBtn"><i
                                class="fa fa-trash text-danger"></i></a>
                        <form id="formDel" action="{{ route('webadminusers.destroy',$user->id) }}" method="post"
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

@if(Session::has('user_added'))
<script>
toastr.success("{!! Session::get('user_added') !!}");
</script>
@endif

@if(Session::has('user_updated'))
<script>
toastr.success("{!! Session::get('user_updated') !!}");
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

@endsection