@extends('layouts.app')

@section('content')
<div class="container" style="background-color: rgba(0, 0, 0, 0.5);">

  <div class="row">
    
    <div id="content" class="col-sm-12">
      <h2>My Account</h2>
      
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <td class="text-left" colspan="2">Order Details</td>
          </tr>
        </thead>
        <tbody>
          <tr>

            <td class="text-left" style="width: 50%;">

              @if(isset($order->invoice_no))
              <b>Invoice No.</b> 
              {{$order->invoice_no}}<br />
              @endif

              @if(isset($order->order_id))
              <b>Order Id</b> 
              {{$order->order_id}}<br />
              @endif

              @if(isset($order->order_date))
              <b>Order Date</b> 
              {{$order->order_date}}<br />
              @endif
            
            <td class="text-left" style="width: 50%;">
              @if(isset($order->payment_method))
              <b>Payment Method</b> 
              {{$order->payment_method}}<br />
              @endif
            </td>
          </tr>
        </tbody>
      </table>

      <table class="table table-bordered table-hover">
        <thead>

          @if(isset($order->billing_first_name))
          <tr>

            <td class="text-left" style="width: 50%; vertical-align: top;">
              Customer Name
            </td>
            
            <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->billing_first_name}} {{$order->billing_last_name}}
            </td>
            
          </tr>
          @endif

          @if(isset($order->country))
          <tr>

            <td class="text-left" style="width: 50%; vertical-align: top;">
             Company Name
            </td>
            
            <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->billing_company_name}}
            </td>
            
          </tr>
          @endif

          @if(isset($order->country->name))
          <tr>

            <td class="text-left" style="width: 50%; vertical-align: top;">
             Country
            </td>
            
            <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->country->name}}
            </td>
            
          </tr>
          @endif

          @if(isset($order->billing_address_1))
          <tr>

            <td class="text-left" style="width: 50%; vertical-align: top;">
              Billing Address 1
            </td>
            
            <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->billing_address_1}}
            </td>
            
          </tr>
          @endif


          @if(isset($order->billing_address_2))
          <tr>

            <td class="text-left" style="width: 50%; vertical-align: top;">
              Billing Address 2
            </td>
            
            <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->billing_address_2}}
            </td>
            
          </tr>
          @endif


          @if(isset($order->billing_town_city))
          <tr>

            <td class="text-left" style="width: 50%; vertical-align: top;">
             Town/City
            </td>
            
            <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->billing_town_city}}
            </td>
            
          </tr>
          @endif


          @if(isset($order->billing_state))
          <tr>

            <td class="text-left" style="width: 50%; vertical-align: top;">
             State
            </td>
            
            <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->billing_state}}
            </td>
            
          </tr>
          @endif

          @if(isset($order->billing_zip))
          <tr>

            <td class="text-left" style="width: 50%; vertical-align: top;">
             Zip Code
            </td>
            
            <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->billing_zip}}
            </td>
            
          </tr>
          @endif


          @if(isset($order->billing_phone))
          <tr>

            <td class="text-left" style="width: 50%; vertical-align: top;">
             Phone
            </td>
            
            <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->billing_phone}}
            </td>
            
          </tr>
          @endif

          @if(isset($order->billing_email))
          <tr>

            <td class="text-left" style="width: 50%; vertical-align: top;">
             Email
            </td>
            
            <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->billing_email}}
            </td>
            
          </tr>
          @endif



        </thead>
      </table>

      <div class="table-responsive">
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
              <td class="text-right">{{$product->price}}</td>
              <td class="text-right">{{$product->quantity * $product->price}}</td>
              
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
     
      <table class="table table-bordered table-hover">
        <thead>
          <tr><td class="text-left">Order Information</td></tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-left">{{$order->order_notes}}</td>
          </tr>
        </tbody>
      </table>
     
    </div>
    </div>
</div>

@endsection