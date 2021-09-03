@extends('admin.app')
@section('title','News & Offers')
@section('header_title','View News & Offers')
@section('maincontent')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">View News & Offers</h3>
        <a href="{{url('webadmin/news-offers/create')}}" class=" btn btn-primary card-title float-right">Add News &
            Offers</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr. #</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($newsOffers as $key => $news)
                <tr>
                    <th class="text-right align-middle">{{$loop->index+1}}</th>
                    <td class=" align-middle">{{$news->title}}</td>
                    <td class=" align-middle">{!! $news->description !!}</td>
                    <td class="text-center align-middle">
                        <img class="rounded" src="{{asset('storage/images/news-offers')}}/{{$news->image}}" height="70"
                            width="70" alt="new_image">
                    </td>
                    <td class=" align-middle">{{$news->type}}</td>
                    <td class=" align-middle">{{$news->show_untill_date}}</td>
                    <td class="text-center align-middle">
                        @if($news->status == 0)
                        <button class="pushy__btn pushy__btn--sm pushy__btn--red change_status_btn enable_disable_news"
                            id="{{$news->id}}">Disabled</button>
                        @else
                        <button
                            class="pushy__btn pushy__btn--sm pushy__btn--green change_status_btn enable_disable_news"
                            id="{{$news->id}}">Enabled</button>
                        @endif
                    </td>
                    <td class=" text-center align-middle">
                        <a href="{{ route('webadminnews-offers.edit', $news->id) }}">
                            <i class="fas fa-edit text-primary"></i>
                        </a>
                        <a href="javascript:void(0);" class="delBtn" id="delBtn"><i
                                class="fa fa-trash text-danger"></i></a>
                        <form id="formDel" action="{{ route('webadminnews-offers.destroy',$news->id) }}" method="post">
                            @csrf @method('delete')
                        </form>
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

@if(Session::has('news_offers_added'))
<script>
toastr.success("{!! Session::get('news_offers_added') !!}");
</script>
@endif

@if(Session::has('news_offers_updated'))
<script>
toastr.success("{!! Session::get('news_offers_updated') !!}");
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
    $(document).on('click', '.enable_disable_news', function() {
        const thisRef = $(this);
        thisRef.text('Processing');
        $.ajax({
            type: 'GET',
            url: 'news-offers/change-status/' + thisRef.attr('id'),
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