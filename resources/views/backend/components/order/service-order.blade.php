@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <h2>Service Enquiry List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Service Enquiry List</strong>
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
                    <h5>Service Enquiry List</h5>
                </div>
                <div class="ibox-content">
                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                            <tr>
                                <th>Member Name</th>
                                <th>Product Name</th>
                                <th>Name of owner</th>
                                <th>Address</th>
                                <th>City/State/Zip</th>
                                <th>Date</th> 
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($services) && count($services) > 0)
                                @foreach($services as $service)
                                    <tr>
                                        <td>{{$service->member->first_name ?? ''}} {{$service->member->last_name ?? ''}}</td>
                                        <td>{{$service->product->name ?? ''}}</td>
                                        <td>{{$service->name_of_owner ?? ''}}</td>
                                        <td>{{$service->address ?? ''}}</td>
                                        <td>{{$service->city ?? ''}}/{{$service->state ?? ''}}/{{$service->zip ?? ''}}</td>
                                        <td>{{$service->created_at ?? ''}}</td>
                                        <td>
                                            @if($service->status == 1)
                                                <span class="badge badge-primary">Completed</span>
                                            @else
                                                <span class="badge badge-danger">On Progress</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{route('admin.service.inquiry.detail',$service->id)}}" title="view order details"><i class="fa fa-eye"></i></a>
                                        </td>

                                       
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No Any enquiry available!</td>
                                    </tr>
                            @endif 
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="12">
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