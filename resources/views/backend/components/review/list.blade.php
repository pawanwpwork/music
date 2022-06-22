@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <h2>Review List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Review List</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.message')
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Review List</h5>
                </div>
                <div class="ibox-content">
                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                            <tr>
                                <th data-toggle="true">Author</th>
                                <th>Product</th>
                                <th>Text</th>
                                <th>Rating</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($reviews) && count($reviews) > 0)
                                @foreach($reviews as $review)
                                    <tr>
                                        <td>{{$review->full_name ?? ''}}</td>
                                        <td>{{$review->product->name ?? ''}}</td>
                                        <td>
                                            {{ $review->review ?? '' }}
                                        </td>
                                        <td>
                                            {{ $review->rating ?? '' }}
                                        </td>
                                        <td>{{ date('F j, Y', strtotime($review->created_at)) ?? ''}}</td>
                                        <td>
                                            @if($review->status == 1)
                                                <span class="badge badge-primary">Published</span>
                                            @else
                                                <span class="badge badge-danger"> Unpublished</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#delete_review" data-remote="{{route('admin.review.delete.confirm',$review->id)}}" data-toggle="modal"  class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            <a href="#delete_review" data-remote="{{route('admin.review.status.confirm',$review->id)}}" data-toggle="modal"  class="btn btn-primary">approved</a>
                                        </td>
                                       
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No review Available!</td>
                                    </tr>
                            @endif 
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <ul class="pagination pull-right"></ul>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<div class="modal fade" id="delete_review" tabindex="-1" role="dialog" aria-labelledby="delete_review" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
   </div>
</div>

@section('footer-scripts')
<script type="text/javascript">
$('#delete_review').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var modal = $(this);
    // or, load content from value of data-remote url
    modal.find('.modal-content').load(button.data("remote"));

});
</script>
@endsection