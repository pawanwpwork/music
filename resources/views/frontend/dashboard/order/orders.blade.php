@extends('layouts.app')

@section('content')
<div class="container" style="background-color: rgba(0, 0, 0, 0.5);">
  <div class="row">
    
    <div id="content" class="col-sm-12">
      <h1>Order History</h1>
      @if(isset($orders) && count($orders)>0)
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-right">Order Id</td>
              <td class="text-left">Full Name</td>
              <td class="text-left">Status</td>
              <td class="text-right">Total</td>
              <td class="text-left">Order Data</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            
                @foreach ($orders as $order)
                    <tr>
                      <td class="text-right">#<?php echo $order->order_id; ?></td>
                      <td class="text-left"><?php echo $order->member->first_name; ?> <?php echo $order->member->last_name; ?></td>
                      <td class="text-left"><?php echo $order->payment_status; ?></td>
                      <td class="text-right">$<?php echo $order->total_amount; ?></td>
                      <td class="text-left"><?php echo date('m/d/Y',strtotime($order->order_date)); ?></td>
                      <td class="text-right"><a href="{{route('frontend.account.order.details',$order->order_id)}}" data-toggle="tooltip" title="order info" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
                    </tr>
               @endforeach

          </tbody>
        </table>
      </div>
      <div class="row">
        <div class="col-sm-6 text-left">{{$orders->render()}}</div>
        <div class="col-sm-6 text-right">{{isset($orders) ? count($orders) : 0}}</div>
      </div>
      @else
      <p>You have not made any previous orders!</p>
      @endif
      </div>
    </div>
</div>

@endsection