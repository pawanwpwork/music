<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="paypal_payment">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="advance-records1@hotmail.com">
  <input type="hidden" name="item_name" value="{{$order->id}}">
  <input type="hidden" name="currency_code" value="USD">
  <input type="hidden" name="amount" value="{{$order->total_amount}}">
  

  <!-- Set variables that override the address stored with PayPal. -->
  <input type="hidden" name="first_name" value="{{$order->billing_first_name}}">
  <input type="hidden" name="last_name" value="{{$order->billing_last_name}}">
  <input type="hidden" name="address1" value="{{$order->billing_address_1}}">
  <input type="hidden" name="address2" value="{{$order->billing_address_2}}">
  <input type="hidden" name="city" value="{{$order->billing_town_city}}">
  <input type="hidden" name="state" value="{{$order->billing_state}}">
  <input type="hidden" name="zip" value="{{$order->billing_zip}}">
  <input type="hidden" name="email" value="{{$order->billing_email}}">
  <input type="hidden" name="country" value="{{$country->code}}">
  <input type="hidden" name="return" value="{{route('paypal.success.url')}}">
  <input type="hidden" name="cancel_return" value="{{route('paypal.cancel.url')}}">
  <input type="image" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online" style="display: none;">
</form>

<script type="text/javascript">
  window.onload = function(){
  document.forms['paypal_payment'].submit();
}
</script>