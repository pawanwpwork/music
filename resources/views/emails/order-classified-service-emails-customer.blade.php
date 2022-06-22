<!DOCTYPE html>
<html>
<head>
	<title>Order Classified Service Email Notification</title>
</head>
<body>
<p>Your Enquiry has been Placed!</p>


<table class="table table-bordered table-hover">
<thead>

  @if(isset($order->dba))
  <tr>
    <td class="text-left" style="width: 50%; vertical-align: top;">DBA</td>
    <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->dba}}</td>
  </tr>
  @endif

  @if(isset($order->address))
  <tr>
    <td class="text-left" style="width: 50%; vertical-align: top;">Address</td>
    <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->address}}</td>
  </tr>
  @endif

  @if(isset($order->city))
  <tr>
    <td class="text-left" style="width: 50%; vertical-align: top;">City</td>
    <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->city}}</td>
  </tr>
  @endif

  @if(isset($order->state))
  <tr>
    <td class="text-left" style="width: 50%; vertical-align: top;">State</td>
    <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->state}}</td>
  </tr>
  @endif


  @if(isset($order->zip))
  <tr>
    <td class="text-left" style="width: 50%; vertical-align: top;">Zip</td>
    <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->zip}}</td>
  </tr>
  @endif


  @if(isset($order->phone_no))
  <tr>
    <td class="text-left" style="width: 50%; vertical-align: top;">Phone no.</td>
    <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->phone_no}}</td>
  </tr>
  @endif


  @if(isset($order->cell_phone))
  <tr>
    <td class="text-left" style="width: 50%; vertical-align: top;">Cell Phone</td>
    <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->cell_phone}}</td>
  </tr>
  @endif

  @if(isset($order->fax))
  <tr>
    <td class="text-left" style="width: 50%; vertical-align: top;">Fax</td>
    <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->fax}}</td>
  </tr>
  @endif


  @if(isset($order->website))
  <tr>
    <td class="text-left" style="width: 50%; vertical-align: top;">Website</td>
    <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->website}}</td>
  </tr>
  @endif

  @if(isset($order->email))
  <tr>
    <td class="text-left" style="width: 50%; vertical-align: top;">Email</td>
    <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->email}}</td>
  </tr>
  @endif

  @if(isset($order->payment_method))
  <tr>
    <td class="text-left" style="width: 50%; vertical-align: top;">Payment Method</td>
    <td class="text-left" style="width: 50%; vertical-align: top;">{{$order->payment_method}}</td>
  </tr>
  @endif

</thead>
</table>


<table class="table table-bordered table-hover">
<thead>
  <tr><td class="text-left">Comments</td></tr>
</thead>
<tbody>
  <tr>
    <td class="text-left">{{$order->comments}}</td>
  </tr>
</tbody>
</table>
</body>
</html>