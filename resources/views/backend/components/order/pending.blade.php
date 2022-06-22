@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <h2>Order Pending List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Order Pending List</strong>
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
                    <h5>Order Pending List</h5>
                </div>
                <div class="ibox-content">
                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                            <tr>
                                <th data-toggle="true">Order Id</th>
                                <th>Full Name</th>
                                <th>Country</th>
                                <th>Address</th>
                                <th>Town/City</th>
                                <th>State</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($orders) && count($orders) > 0)
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->order_id ?? ''}}</td>
                                        <td>{{$order->billing_first_name ?? ''}} {{$order->billing_last_name ?? ''}}</td>

                                        <td>{{$order->country->name ?? ''}}</td>

                                        <td>{{$order->billing_address_1 ?? ''}} / {{$order->billing_address_2 ?? ''}}</td>

                                        <td>{{$order->billing_town_city ?? ''}}</td>

                                        <td>{{$order->billing_state ?? ''}}</td>

                                        <td>{{$order->billing_phone ?? ''}}</td>

                                        <td>{{$order->payment_status ?? ''}}</td>


                                        <td>{{ isset($order->order_date) ? date('m/d/Y',strtotime($order->order_date) ) : ''}}</td>

                                        <td><span class="badge badge-warning">{{$order->payment_status ?? ''}}</span></td>

                                        <td>
                                            <a href="{{route('admin.order.details',$order->order_id)}}" title="view order details"><i class="fa fa-eye"></i></a>
                                        </td>

                                       
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No Pending Order Available!</td>
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