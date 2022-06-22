@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <h2>Event List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Event List</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-6 col-md-6 padding20">
        <div class="pull-right">
            <a href="{{route('admin.event.create')}}" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
        </div>
        
    </div>
</div>

@include('backend.components.event.includes._search_form')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.message')
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Event List</h5>

                </div>
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                            <tr>
                                <th data-toggle="true">Event Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Location</th>
                                <th>Event Time</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($events) && count($events) > 0)
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{$event->name ?? ''}}</td>
                                        <td>{{$event->description ?? ''}}</td>
                                        <td>
                                            <a href="{{route('admin.event.storage',$event->id)}}" target="_blank"><img src="{{route('admin.event.storage',$event->id)}}" width="80px" height="80px" class="img-thumbnail"></a>
                                        </td>
                                        <td>{{ $event->location ?? '' }}</td>
                                        <td>{{ $event->time ?? '' }}</td>
                                        <td>{{ date('F j, Y', strtotime($event->date_start)) ?? '' }}</td>
                                        <td>{{ date('F j, Y', strtotime($event->date_end)) ?? '' }}</td>
                                        <td>{{ $event->sub_total ?? '' }}</td>
                                        <td>
                                            @if($event->status == 'approved')
                                                <span class="badge badge-primary">Approved</span>
                                            @elseif($event->status == 'pending')
                                                <span class="badge badge-warning"> Pending</span>
                                            @else
                                                <span class="badge badge-danger"> Cancel</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.event.edit',$event->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="#delete_event" data-remote="{{route('admin.event.delete.confirm',$event->id)}}" data-toggle="modal"  class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                       
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No event Available!</td>
                                    </tr>
                            @endif 
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
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
<div class="modal fade" id="delete_event" tabindex="-1" role="dialog" aria-labelledby="delete_event" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
   </div>
</div>

@section('footer-scripts')
<script type="text/javascript">
$('#delete_event').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var modal = $(this);
    // or, load content from value of data-remote url
    modal.find('.modal-content').load(button.data("remote"));

});
</script>
@endsection