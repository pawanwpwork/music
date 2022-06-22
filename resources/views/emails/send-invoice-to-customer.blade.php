<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Allmusicallartist | Invoice</title>

    <style>
      .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
      }

      .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
      }

      .invoice-box table td {
        padding: 5px;
        vertical-align: top;
      }

      .invoice-box table tr td:nth-child(2) {
        text-align: right;
      }

      .invoice-box table tr.top table td {
        padding-bottom: 20px;
      }

      .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
      }

      .invoice-box table tr.information table td {
        padding-bottom: 40px;
      }

      .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
      }

      .invoice-box table tr.details td {
        padding-bottom: 20px;
      }

      .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
      }

      .invoice-box table tr.item.last td {
        border-bottom: none;
      }

      .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
      }

      @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
          width: 100%;
          display: block;
          text-align: center;
        }

        .invoice-box table tr.information table td {
          width: 100%;
          display: block;
          text-align: center;
        }
      }

      /** RTL **/
      .invoice-box.rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      }

      .invoice-box.rtl table {
        text-align: right;
      }

      .invoice-box.rtl table tr td:nth-child(2) {
        text-align: left;
      }

      .btn-primary {
          background-color: #1ab394;
          border-color: #1ab394;
          color: #FFFFFF;
      }

      .btn {
          display: inline-block;
          padding: 6px 12px;
          margin-bottom: 0;
          font-size: 14px;
          font-weight: 400;
          line-height: 1.42857143;
          text-align: center;
          white-space: nowrap;
          vertical-align: middle;
          -ms-touch-action: manipulation;
          touch-action: manipulation;
          cursor: pointer;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
          background-image: none;
          border: 1px solid transparent;
          border-radius: 4px;
      }
    </style>
  </head>

  <body id="invoicePrint">
    @php $siteSetting = siteSetting(); @endphp
    <div class="invoice-box">
      <table cellpadding="0" cellspacing="0">
        <tr class="top">
          <td colspan="2">
            <table>
              <tr>
                <td class="title">
                  <img src="{{asset('assets/images/logo.png')}}" style="width: 30%; max-width: 300px" />
                </td>

                <td>
                  <h1>Invoice</h1>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr class="information" >
          <td colspan="2">
            <table>
              <tr>
                <td>
                  {!!isset($siteSetting->title) ? $siteSetting->title.'<br />' : 'N/A'!!}
                  {!!isset($siteSetting->address_1) ? $siteSetting->address_1.'<br />' : 'N/A'!!}
                  {!!isset($siteSetting->address_2) ? $siteSetting->address_2.'<br />' : 'N/A'!!}
                  {!!isset($siteSetting->mobile) ? $siteSetting->mobile.'<br />' : 'N/A'!!}
                  {!!$siteSetting->email!!}
                </td>

                <td>
                  Invoice No.: #{{$order->invoice_no}}<br />
                  Date.: {{date('m/d/Y',strtotime($order->order_date))}}<br />
                  Customer ID.: 0000{{$order->member_id}}<br />
                  Customer Name.: {{$order->billing_first_name}} {{$order->billing_last_name}}<br />
                  Status.: {{$order->payment_status}}
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr class="heading">
          <td>Payment Method</td>

          <td>{{$order->payment_method}} #</td>
        </tr>

        <tr class="details">
          <td>{{$order->payment_method}}</td>

          <td>${{$order->total_amount}}</td>
        </tr>
      </table>

      <table cellpadding="0" cellspacing="0">
        <tr class="heading">
          <td>Product Name</td>
              <td>Product Model/Type</td>
              <td>Quantity</td>
              <td>Price</td>
              <td>Total</td>
        </tr>

         @if (isset($order->product))
            @foreach ($order->product as $product)
            <tr class="item">
              @php 
                $productDetail = productDetailByTypeProductId($product->id,$product->type);
              @endphp
              <td>{{$productDetail['product_name']}}</td>
              <td>{{$productDetail['model']}}</td>
              <td>{{$product->quantity}}</td>
              <td>${{$product->price}}</td>
              <td>${{$product->quantity * $product->price}}</td>
              
            </tr>
        @endforeach
        @endif
        
        <tr class="total">
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>Total:${{$order->total_amount}}</td>
        </tr>
      </table>
    </div>
   
  </body>
</html>