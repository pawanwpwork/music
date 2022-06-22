<?php

namespace App\Http\Controllers\Frotend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Event;
use App\Models\BookBandDj;
use Auth;

class CartController extends Controller
{

    public function __construct(){
        $this->middleware('auth:member');
    }

    public function cartPage(){
         $memberData = Auth::guard('member')->user();
         $cartItems = Cart::where('member_id',$memberData->id)->get();
        return view('frontend.cart.index',compact('cartItems'));
    }

    public function addToCartClassifiedProduct($id,Request $request){
    	// dd($request->all());
    	$productId = decrypt($id);
    	$memberId = authGuardData('member')->id;;
    	$data = Product::find($productId);

    	$checkCartItems = Cart::where('member_id',$memberId)->where('product_id',$productId)->get();

    	if(isset($checkCartItems) && count($checkCartItems) > 0){
    		return redirect()->route('frontend.cart')->withMessage('Item has been already added into cart!');
    	}

    	$cart = new Cart();
        $cart->member_id = $memberId;
        $cart->type = 'classified_buy';
        $cart->product_name = $data->name;
        $cart->price = $data->price;
        $cart->quantity = $request->quantity;        
        $cart->product_id = $productId;
        if($cart->save()){
        	return redirect()->route('frontend.cart')->withMessage('Item has been added to cart!');
        }
    }


    public function addToCartCdProduct($id,Request $request){
        // dd($request->all());
        $productId = decrypt($id);
        $memberId = authGuardData('member')->id;;
        $data = Product::find($productId);

        $checkCartItems = Cart::where('member_id',$memberId)->where('product_id',$productId)->get();

        if(isset($checkCartItems) && count($checkCartItems) > 0){
            return redirect()->route('frontend.cart')->withMessage('Item has been already added into cart!');
        }

        $cart = new Cart();
        $cart->member_id = $memberId;
        $cart->type = 'cd_buy';
        $cart->product_name = $data->name;
        $cart->price = $data->price;
        $cart->quantity = $request->quantity;        
        $cart->product_id = $productId;
        if($cart->save()){
            return redirect()->route('frontend.cart')->withMessage('Item has been added to cart!');
        }
    }


    public function updateCart(Request $request){
        
        if(isset($request->cart) && count($request->cart) > 0){
            foreach ($request->cart as $item ) {
                $cartId = decrypt($item['id']);
                $cartUpdate = Cart::find($cartId);
                // dd($cartUpdate);
                if(isset($item['quantity']) && $cartUpdate->quantity != $item['quantity']){
                    $cartUpdate->quantity = $item['quantity'];
                    $cartUpdate->save();
                }
                else
                {
                    $cartUpdate->quantity = 1;
                    $cartUpdate->save();
                }
            }
        }
        return redirect()->route('frontend.cart')->withMessage('Cart has been updated!');
    }

    public function removeCart(Request $request){
        $cartId = decrypt($request->jptalpha);
        $cartDelete = Cart::find($cartId);
        if( isset( $cartDelete->type ) && $cartDelete->type == 'classified_sell')
        {
             Product::find($cartDelete->product_id)->forceDelete();
             if($cartDelete->delete()){
                return redirect()->route('frontend.cart')->withMessage('Item '.$cartDelete->product_name.' has been removed!');       
            }
        }

        if( isset( $cartDelete->type ) && $cartDelete->type == 'classified_buy')
        {
             Product::find($cartDelete->product_id)->forceDelete();
             if($cartDelete->delete()){
                return redirect()->route('frontend.cart')->withMessage('Item '.$cartDelete->product_name.' has been removed!');       
            }
        }
        
         if( isset( $cartDelete->type ) && $cartDelete->type == 'cd_buy')
        {
             Product::find($cartDelete->product_id)->forceDelete();
             if($cartDelete->delete()){
                return redirect()->route('frontend.cart')->withMessage('Item '.$cartDelete->product_name.' has been removed!');       
            }
        }

        if( isset( $cartDelete->type ) && $cartDelete->type == 'event')
        {
             Event::find($cartDelete->product_id)->forceDelete();
             if($cartDelete->delete()){
                return redirect()->route('frontend.cart')->withMessage('Item '.$cartDelete->product_name.' has been removed!');       
            }
        }

         if( isset( $cartDelete->type ) && $cartDelete->type == 'book_band_dj')
        {
             BookBandDj::find($cartDelete->product_id)->forceDelete();
             if($cartDelete->delete()){
                return redirect()->route('frontend.cart')->withMessage('Item '.$cartDelete->product_name.' has been removed!');       
            }
        }
    }
}
