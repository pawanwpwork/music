@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <h2>Booking Band/Dj List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Booking Band/Dj List</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-6 col-md-6 padding20">
        <div class="pull-right">
            <a href="{{route('admin.banddjbook.create')}}" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
        </div>
        
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            @include('layouts.message')
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Booking Band/Dj List</h5>

                </div>
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                            <tr>
                                <th data-toggle="true">Event Type</th>
                                <th>Event Category</th>
                                <th>Age Bookhand Member</th>
                                <th>Name</th>
                                <th>Contact Number</th>
                                <th>Event Date</th>
                                <th>Address</th>
                                <th>Budget</th>
                                <th>Music Type</th>
                                <th>Order Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(isset($books) && count($books)>0)
                                @foreach($books as $book)
                                    <tr>
                                        <td>{{$book->type}}</td>
                                        <td>@foreach($book->event_type as $bet){{$bet->name}}, @endforeach</td>
                                        <td>@foreach($book->age as $ba){{$ba->name}}, @endforeach</td>
                                        <td>{{$book->name}}</td>
                                        <td>{{$book->contact_number}}</td>
                                        <td>{{date('m/d/Y',strtotime($book->event_date))}}</td>
                                        <td>{{$book->address}}</td>
                                        <td>{{$book->budget}}</td>
                                        <td>{{$book->music_type}}</td>
                                        <td>
                                            @if( $book->order_status == 0 )
                                                Pending
                                            @endif
                                            @if( $book->order_status == 1 )
                                                Success
                                            @endif

                                            @if( $book->order_status == 2 )
                                                Cancel
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.banddjbook.edit',$book->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="#delete_banddjbook" data-remote="{{route('admin.banddjbook.delete.confirm',$book->id)}}" data-toggle="modal"  class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            <a href="#cancel_book" data-remote="{{route('admin.banddjbook.cancel.modal',$book->id)}}" data-toggle="modal" class="btn btn-warning">Cancel Booking</a>
                                        </td>
                                       
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No Band/Dj Book Available!</td>
                                    </tr>
                            @endif 
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <ul class="pagination pull-right">{!! $books->links() !!}</ul>
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

<div class="modal fade" id="delete_banddjbook" tabindex="-1" role="dialog" aria-labelledby="delete_book" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
   </div>
</div>

<div class="modal fade" id="cancel_book" tabindex="-1" role="dialog" aria-labelledby="cancel_book" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
   </div>
</div>

@section('footer-scripts')
<script type="text/javascript">
$('#delete_book').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var modal = $(this);
    // or, load content from value of data-remote url
    modal.find('.modal-content').load(button.data("remote"));

});
</script>
@endsection