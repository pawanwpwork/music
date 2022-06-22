@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6">
        <h2>Order #{{$order->order_id}}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Order #{{$order->order_id}}</strong>
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
                  
                    <h5>Order Details @if(isset($order->invoice_no)) <span style="font-size: 19px;">Invoice #{{$order->invoice_no}}</span> @endif </h5>

                    @if($order->payment_status == 'completed')
                    <div class="generate-invoice">
                      <a href="{{route('admin.invoice.preview',$order->order_id)}}" class="btn btn-primary">Generate Invoice</a>
                    </div>
                    @endif
                </div>
                <div class="ibox-content">
                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                       <tr>
                           <th>Order Id</th>
                           <td>#{{$order->order_id ?? 'N/A'}}</td>
                           <th>Order Date</th>
                           <td>{{date('d/m/Y',strtotime($order->order_date))}}</td>
                       </tr>

                        <tr>
                           <th>Full Name</th>
                           <td>{{$order->billing_first_name}} {{$order->billing_last_name}}</td>
                           <th>Company Name</th>
                           <td>{{$order->billing_company_name ?? 'N/A'}}</td>
                       </tr>

                       <tr>
                            <th>Country</th>
                            <td>{{$order->country->name}}</td>
                            <th>Address</th>
                            <td>{{$order->billing_address_1 ?? 'N/A'}} / {{$order->billing_address_2 ?? 'N/A'}}</td>
                       </tr>

                        <tr>
                            <th>Town/City</th>
                            <td>{{$order->billing_town_city ?? 'N/A'}}</td>
                            <th>State</th>
                            <td>{{$order->billing_state ?? 'N/A'}}</td>
                        </tr>

                        <tr>
                            <th>Zip Code</th>
                            <td>{{$order->billing_zip ?? 'N/A'}}</td>
                            <th>Phone</th>
                            <td>{{$order->billing_phone ?? 'N/A'}}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{$order->billing_email ?? 'N/A'}}</td>
                            <th>Sub-total</th>
                            <td>${{$order->subtotal_amount ?? 'N/A'}}</td>
                        </tr>

                        <tr>
                            <th>Total</th>
                            <td>${{$order->total_amount ?? 'N/A'}}</td>
                            <th>Payment Method</th>
                            <td>{{$order->payment_method ?? 'N/A'}}</td>
                        </tr>

                        <tr>
                            <th>Payment Status</th>
                            <td>{{$order->payment_status ?? 'N/A'}}</td>
                            <th>Order Notes</th>
                            <td>{{$order->order_notes ?? 'N/A'}}</td>
                        </tr>

                    </table>

                    <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <td class="text-left">Product Name</td>
                              <td class="text-left">Product Model/Type</td>
                              <td class="text-right">Quantity</td>
                              <td class="text-right">Price</td>
                              <td class="text-right">Total</td>
                             
                            </tr>
                          </thead>
                          <tbody>
                            @if (isset($order->product))
                            @foreach ($order->product as $product)
                            <tr>
                              @php 
                                $productDetail = productDetailByTypeProductId($product->id,$product->type);
                              @endphp
                              <td class="text-left">{{$productDetail['product_name']}}</td>
                              <td class="text-left">{{$productDetail['model']}}</td>
                              <td class="text-right">{{$product->quantity}}</td>
                              <td class="text-right">${{$product->price}}</td>
                              <td class="text-right">${{$product->quantity * $product->price}}</td>
                              
                            </tr>
                           @endforeach
                           @else
                            <tr>
                              <td colspan="5">No Product!</td>
                            </tr>
                           @endif
                          </tbody>
                          <tfoot>
                           
                            <tr>
                              <td colspan="3"></td>
                              <td class="text-right"><b>Total Price</b></td>
                              <td class="text-right">${{$order->total_amount}}</td>
                             
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