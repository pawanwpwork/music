@extends('layouts.app')

@section('content')
<div class="sitecontent__outer">
        <div class="container">
            <div class="sitecontent">
                <div class="box">
                    <div class="cart__wrap">
                        <h1 class="heading-page">Cart</h1>
                        @include('layouts.message')
                        <div class="cart__table-wrap">
                            <table class="cart__table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="cart-item-remove">  &nbsp; </th>
                                        <th class="cart-item-thumbnail"></th>
                                        <th class="cart-item-name">Cart item</th>
                                        <th class="cart-item-price">Price</th>
                                        <th class="cart-item-quantity">Quantity</th>
                                        <th class="cart-item-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                    $cartTotal = 0;
                                    $i=1;
                                    @endphp
                                    @if(isset($cartItems) && count($cartItems))
                                     <form class="cartForm" action="{{route('frontend.update.cart')}}" method="POST">
                                        @foreach($cartItems as $cart)

                                            @php 
                                                $itemsByType = itemByTypeHelper($cart);
                                                $cartTotal = $cartTotal + $itemsByType['total'];
                                            @endphp
                                           
                                            <tr>
                                                @csrf()
                                                <input type="hidden" name="cart[{{$i}}][id]" value="{{encrypt($cart->id)}}">
                                               
                                                <td class="cart-item-remove" id="{{encrypt($cart->id)}}"><i class="fa fa-times"></i></td>
                                               
                                                <td class="cart-item-thumbnail">
                                                    @if(isset($itemsByType['image']))
                                                        <img src="{{$itemsByType['image']}}" alt="">
                                                    @endif
                                                </td>
                                                <td class="cart-item-name">
                                                    <h3><a href="{{$itemsByType['item_url']}}">{{$itemsByType['product_name']}}</a></h3>
                                                </td>
                                                <td class="cart-item-price">${{$itemsByType['price']}}</td>
                                                <td class="cart-item-quantity">
                                               
                                                @if($cart->type == 'classified_buy' || $cart->type == 'cd_buy')
                                                <input type="number" name="cart[{{$i}}][quantity]" value="{{$itemsByType['quantity']}}" min="1" style="line-height: 0rem;text-align: center;">      
                                                @else
                                                 {{$itemsByType['quantity']}}
                                                 @endif

                                                </td>
                                                <td class="cart-item-subtotal">${{$itemsByType['total']}}</td>
                                            </tr>
                                            
                                            @php $i++;@endphp
                                        @endforeach
                                        </form>
                                        @else
                                        <tr>
                                            <td colspan="6">No item in Cart</td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6" class="cart-item-actions">
                                        <input type="button" class="cart-button-updatecart" value="Update cart">
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        @if($cartTotal > 0)
                        <div class="cart__subtotal-wrap mt-5">
                            <div class="cart__subtotal">
                                <h2 class="heading">Cart Totals</h2>
                                <table class="cart__table" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td class="cart-item-name">Subtotal</td>
                                            <td class="cart-item-subtotal">${{$cartTotal}}</td>
                                        </tr>
                                        <tr>
                                            <td class="cart-item-name">Total</td>
                                            <td class="cart-item-subtotal">${{$cartTotal}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="cart__checkout">
                                    <a href="{{route('frontend.checkout')}}">Proceed to checkout <i class="far fa-arrow-alt-circle-right "></i></a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="removeItemModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Remove Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{route('frontend.remove.cart')}}" method="POST">
              @csrf()
              <input type="hidden" name="jptalpha">
              <div class="modal-body">
               Are you sure to remove this item?
              </div>
              <div class="modal-footer">
                <button type="submit" class="cart-button-remove">Save changes</button>
              </div>
          </form>
        </div>
      </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('.cart-button-updatecart').on('click',function(){
        $(".cartForm").submit();
    });

    $('.cart-item-remove').on('click',function(){

        $("input[name=jptalpha]").val($(this).attr('id'));
        $("#removeItemModal").modal('show');
    })
</script>
@endsection