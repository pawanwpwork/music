@extends('layouts.app')

@section('content')
  <div class="sitecontent__outer">
        <div class="container">
            <div class="sitecontent">
                <div class="box">
                    <form action="{{route('frontend.payment.now')}}" class="checkout__form" method="POST">
                    <div class="checkout__wrap">
                        <h1 class="heading-page">Checkout</h1>
                        @include('layouts.message')
                        <div class="checkout__form-wrap">
                                @csrf()

                                <div class="row checkout__form-outerrow">
                                    <div class="col-md-6 checkout__form-col">
                                        <h2 class="heading">Billing Details</h2>
                                        <div class="row checkout__form-innerrow">
                                            <div class="formfield form-important col-md-6">
                                                <label for="billing_first_name">First Name</label>
                                                <input type="text" name="billing_first_name" id="billing_first_name" value="{{old('billing_first_name',authGuardData('member')->first_name)}}" readonly>
                                            </div>
                                            <div class="formfield form-important col-md-6">
                                                <label for="billing_last_name">Last Name</label>
                                                <input type="text" name="billing_last_name" id="billing_last_name" value="{{old('billing_last_name',authGuardData('member')->last_name)}}" readonly>
                                            </div>
                                            <div class="formfield col-12">
                                                <label for="billing_company_name">Company Name</label>
                                                <input type="text" name="billing_company_name" id="billing_company_name" value="{{old('billing_company_name')}}">
                                            </div>
                                            <div class="formfield col-12">
                                                <label for="billing_country">Country</label>
                                                <select name="country_id" id="country_id">
                                                    <option value="">Select a country</option>
                                                    @if(isset($countries) && count($countries)>0)
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->id}}" {{old('country_id') == $country->id ? 'selected' : ''}}>{{$country->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="formfield form-important col-12">
                                                <label for="billing_address_1">Street Address</label>
                                                <input type="text" name="billing_address_1" id="billing_address_1"
                                                    placeholder="House Number and street name" value="{{old('billing_address_1')}}">
                                                <input type="text" name="billing_address_2" id="billing_address_2"
                                                    placeholder="Apartment, suite, unit etc. (optional)" value="{{old('billing_address_2')}}">
                                            </div>
                                            <div class="formfield col-12">
                                                <label for="billing_town_city">Town/ City</label>
                                                <input type="text" name="billing_town_city" id="billing_town_city" value="{{old('billing_town_city')}}">
                                            </div>
                                            <div class="formfield col-12">
                                                <label for="billing_state">State</label>
                                                <input type="text" name="billing_state" id="billing_state" value="{{old('billing_state')}}">
                                            </div>
                                            <div class="formfield col-12">
                                                <label for="billing_zip">Zip</label>
                                                <input type="text" name="billing_zip" id="billing_zip" value="{{old('billing_zip')}}">
                                            </div>
                                            <div class="formfield form-important col-md-6">
                                                <label for="billing_phone">Phone</label>
                                                <input type="tel" name="billing_phone" id="billing_phone" value="{{old('billing_phone')}}">
                                            </div>
                                            <div class="formfield form-important col-md-6">
                                                <label for="billing_email">Email Address</label>
                                                <input type="tel" name="billing_email" id="billing_email" value="{{old('billing_email')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 checkout__form-col">
                                        <h2 class="heading">Additional Information</h2>
                                        <div class="formfield">
                                            <label for="order_notes">Order notes</label>
                                            <textarea name="order_notes" id="order_notes" placeholder="Notes about your order, e.g. special notes for delivery.">{{old('order_notes')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="ordertable__wrap">
                            <h2 class="heading">Your Order</h2>
                            <table class="ordertable" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="ordertable-name">Product</th>
                                        <th class="ordertable-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php  $cartTotal = 0; @endphp
                                    
                                    @if(isset($cartItems) && count($cartItems))
                                        @foreach($cartItems as $cart)
                                        @php 
                                            $itemsByType = itemByTypeHelper($cart);
                                            $cartTotal = $cartTotal + $itemsByType['total'];
                                        @endphp
                                        <tr>
                                            <td class="ordertable-name">{{$itemsByType['product_name']}} x  {{$itemsByType['quantity']}}</td>
                                            <td class="ordertable-total">${{$itemsByType['total']}}</td>
                                        </tr>
                                         @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="ordertable-name">Subtotal</td>
                                        <td class="ordertable-total">${{$cartTotal}}</td>
                                    </tr>
                                    <tr>
                                        <td class="ordertable-name">Total</td>
                                        <td class="ordertable-total">${{$cartTotal}}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-methods box-inner">
                            <div class="form-check customradio">
                                <input type="radio" name="payment_method" id="paymentMethod" value="Paypal">
                                <label for="paymentMethod">Paypal <img src="{{asset('images/paypal-method.png')}}" alt="Paypal Payment"></label>
                            </div>
                              <div class="formfield">
                                @php 
                                    $term = App\Models\Page::find(2);
                                @endphp
                                <div class="music-terms-and-conditions" style="max-height: 200px; overflow: auto;">
                                    {!!$term->content ?? ''!!}
                                </div>

                                <label class="terms-checkbox">
                                    <input type="checkbox" class="input-checkbox" name="terms" id="terms" required>
                                    <span class="music-terms-and-conditions-checkbox-text">
                                        I have read and agree to the website 
                                        <a href="javascript:void(0)" class="music-terms-and-conditions-link" data-toggle="music-terms-and-conditions">terms and conditions</a></span>&nbsp;<span class="required">*</span>
                                </label>

                            </div>
                            <div class="payment-methods-link">
                                <button type="submit">Proceed to Payment</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection