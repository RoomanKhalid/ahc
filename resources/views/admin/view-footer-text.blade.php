@extends('admin.app')
@section('title','Footer Section')
@section('header_title','View Footer Text')
@section('maincontent')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">View Footer Texts</h3>
        <a href="{{url('webadmin/footer-section/create')}}" class=" btn btn-primary card-title float-right">Add Footer
            Text</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr. #</th>
                    <th>Prefix Line</th>
                    <th>Postfix Words</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1
                @endphp
                @foreach($footerTexts as $key => $text)
                <tr>
                    <th class="text-right align-middle">{{$key+1}}</th>
                    <td class=" align-middle">{{$text->prefix_line}}</td>
                    <td class=" align-middle">{{$text->prefix_line}}</td>
                    <!-- <td class=" align-middle">1</td>
                    <td class=" align-middle">1</td>
                    <td class=" align-middle">1</td>
                    <td class=" align-middle">1</td> -->
                    </td>
                    @php
                    $i++;
                    @endphp
                    <td class="text-center align-middle">
                        @if($text->status == 0)
                        <button class="pushy__btn pushy__btn--sm pushy__btn--red change_status_btn enable_disable_text"
                            id="{{$text->id}}">Disabled</button>
                        @else
                        <button
                            class="pushy__btn pushy__btn--sm pushy__btn--green change_status_btn enable_disable_text"
                            id="{{$text->id}}">Enabled</button>
                        @endif
                    </td>
                    <td class=" text-center align-middle">
                        <a href="{{ route('webadminfooter-section.edit', $text->id) }}">
                            <i class="fas fa-edit text-primary"></i>
                        </a>
                        <a href="javascript:void(0);" class="" id="delBtn"><i class="fa fa-trash text-danger"></i></a>
                        <form id="formDel" action="{{ route('webadminfooter-section.destroy',$text->id) }}"
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

@if(Session::has('text_added'))
<script>
toastr.success("{!! Session::get('text_added') !!}");
</script>
@endif

@if(Session::has('text_deleted'))
<script>
toastr.success("{!! Session::get('text_deleted') !!}");
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
    $(document).on('click', '.enable_disable_text', function() {
        const thisRef = $(this);
        thisRef.text('Processing');
        $.ajax({
            type: 'GET',
            url: 'footer-section/change-status/' + thisRef.attr('id'),
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