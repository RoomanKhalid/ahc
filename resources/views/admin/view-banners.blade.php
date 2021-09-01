@extends('admin.app')
@section('title','Banners Section')
@section('header_title','View Banners')
@section('maincontent')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">View Banners</h3>
        <a href="{{url('webadmin/banner/create')}}" class=" btn btn-primary card-title float-right">Add Banner</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr. #</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1
                @endphp
                @foreach($banners as $key => $banner)
                <tr>
                    <th class="text-right align-middle">{{$key+1}}</th>
                    <td class=" align-middle">{{$banner->name}}</td>
                    <td class="text-center align-middle"><img class="rounded" src="{{asset('storage/images/banners')}}/{{$banner->image}}" height="70"
                            width="70" alt="Banner_image">
                    </td>
                    @php
                    $i++;
                    @endphp
                    <td class="text-center align-middle">
                        @if($banner->status == 0)
                        <button class="pushy__btn pushy__btn--sm pushy__btn--red change_status_btn enable_disable_banner"
                            id="{{$banner->id}}">Disabled</button>
                        @else
                        <button
                            class="pushy__btn pushy__btn--sm pushy__btn--green change_status_btn enable_disable_banner"
                            id="{{$banner->id}}">Enabled</button>
                        @endif
                    </td>
                    <td class=" text-center align-middle">
                        <a href="{{ route('webadminbanner.edit', $banner->id) }}">
                            <i class="fas fa-edit text-primary"></i>
                        </a>
                        <a href="javascript:void(0);" class="" id="delBtn"><i class="fa fa-trash text-danger"></i></a>
                        <form id="formDel" action="{{ route('webadminbanner.destroy',$banner->id) }}"
                            method="post" id="delete-{{$key}}"> @csrf @method('delete') </form>
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

@if(Session::has('banner_added'))
<script>
toastr.success("{!! Session::get('banner_added') !!}");
</script>
@endif

@if(Session::has('banner_deleted'))
<script>
toastr.success("{!! Session::get('banner_deleted') !!}");
</script>
@endif

@if(Session::has('banner_updated'))
<script>
toastr.success("{!! Session::get('banner_updated') !!}");
</script>
@endif

<script>
$('#delBtn').click(function() {
    var abc = confirm("Are you sure?");
    if (abc) {
        $('#formDel').submit();
    } else {
        e.preventDefault();
    }
})
</script>

<script>
$(document).ready(function() {
    $(document).on('click', '.enable_disable_banner', function() {
        const thisRef = $(this);
        thisRef.text('Processing');
        $.ajax({
            type: 'GET',
            url: 'banner/change-status/' + thisRef.attr('id'),
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