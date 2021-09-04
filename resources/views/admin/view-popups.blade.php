@extends('admin.app')
@section('title','Popups Section')
@section('header_title','View Popups')
@section('maincontent')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">View Popups</h3>
        <a href="{{url('webadmin/popup/create')}}" class=" btn btn-primary card-title float-right">Add New Popup</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr. #</th>
                    <th>Popup Title</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1
                @endphp
                @foreach($popups as $key => $popup)
                <tr>
                    <th class="text-right align-middle">{{$key+1}}</th>
                    <td class=" align-middle">{{$popup->title}}</td>
                    <td class="text-center align-middle">
                        <img src="{{$popup->image}}" class="rounded" height="70" width="70" alt="">
                    </td>
                    @php
                    $i++;
                    @endphp
                    <td class="text-center align-middle">
                        @if($popup->status == 0)
                        <button class="pushy__btn pushy__btn--sm pushy__btn--red change_status_btn enable_disable_text"
                            id="{{$popup->id}}">Disabled</button>
                        @else
                        <button
                            class="pushy__btn pushy__btn--sm pushy__btn--green change_status_btn enable_disable_text"
                            id="{{$popup->id}}">Enabled</button>
                        @endif
                    </td>
                    <td class=" text-center align-middle">
                        <a href="{{ route('webadminpopup.edit', $popup->id) }}">
                            <i class="fas fa-edit text-primary"></i>
                        </a>
                        <a href="javascript:void(0);" class="delBtn" id="delBtn"><i
                                class="fa fa-trash text-danger"></i></a>
                        <form id="formDel" action="{{ route('webadminpopup.destroy',$popup->id) }}" method="post"
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

@if(Session::has('popup_added'))
<script>
toastr.success("{!! Session::get('popup_added') !!}");
</script>
@endif

@if(Session::has('popup_updated'))
<script>
toastr.success("{!! Session::get('popup_updated') !!}");
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
    $(document).on('click', '.enable_disable_text', function() {
        const thisRef = $(this);
        thisRef.text('Processing');
        $.ajax({
            type: 'GET',
            url: 'popup/change-status/' + thisRef.attr('id'),
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