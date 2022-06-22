<?php

namespace App\Http\Controllers\Frotend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Member;
use App\Models\BookBandDj;
use App\Models\Event;
use App\Models\Product;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ServiceOrder;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\ClassifiedServiceRequest;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderNotificationForAdmin;
use App\Mail\OrderNotificationForCustomer;
use App\Mail\OrderClassifiedServiceNotificationForAdmin;
use App\Mail\OrderClassifiedServiceNotificationForCustomer;
use App\Music\Services\Product\ProductService;
use Auth;
use Mail;


class CheckoutController extends Controller
{
     protected $productService;

     public function __construct( ProductService $productService){
        $this->productService = $productService;
        $this->middleware('auth:member');
    }

    public function checkout(){
        $memberData = Auth::guard('member')->user();
        $cartItems = Cart::where('member_id',$memberData->id)->get();
        $countries = Country::all();

        return view('frontend.checkout.index',compact('cartItems','countries'));
    }

    public function payNow(CheckoutRequest $request){
    	
        try {
            DB::beginTransaction();

        	$memberData = Auth::guard('member')->user();
            
            $cartItems = Cart::where('member_id',$memberData->id)->get();

        	$order = new Order();

        	$order->member_id = Auth::guard('member')->user()->id;

            $order->order_id = time();

        	$order->order_date = date('Y-m-d');

        	$order->billing_first_name = $request->billing_first_name;

        	$order->billing_last_name = $request->billing_last_name;

        	$order->billing_company_name = $request->billing_company_name;

        	$order->country_id = $request->country_id;

        	$order->billing_address_1 = $request->billing_address_1;

        	$order->billing_address_2 = $request->billing_address_2;

        	$order->billing_town_city = $request->billing_town_city;

        	$order->billing_state = $request->billing_state;

        	$order->billing_zip = $request->billing_zip;

        	$order->billing_phone = $request->billing_phone;

        	$order->billing_email = $request->billing_email;

        	$order->subtotal_amount = $this->cartTotalAmount();

        	$order->total_amount = $this->cartTotalAmount();

        	$order->payment_method = $request->payment_method;

    		$order->payment_status = 'pending';

    		if($order->save()){

    			if(isset($cartItems) && count($cartItems)){
    	    		foreach($cartItems as $cart){
    					$orderProduct = new OrderProduct();
    					$orderProduct->order_id = $order->id;
    					$orderProduct->product_id = $cart->product_id;
    					$orderProduct->type = $cart->type;
    					$orderProduct->price = $cart->price;
    					$orderProduct->quantity = $cart->quantity;
    					$orderProduct->cart_id = $cart->id;
                        $orderProduct->is_upgrade = $cart->is_upgrade;
                        $orderProduct->member_type_id = $cart->member_type_id;
    					$orderProduct->save();
    	    		}
                    DB::commit();
        		}

        		$country = Country::find($order->country_id);
        		return view('frontend.checkout.paypal-form',compact('order','country'));

    		}

         } catch (UserNotFoundException $e) {
             DB::rollback();
            return redirect()->back()->withErrors('Unable to to register please try again.')->withInput($request->all());

        }  
    }


    public function cartTotalAmount(){
    	$cartTotal = 0;
    	$memberData = Auth::guard('member')->user();
    	$cartItems = Cart::where('member_id',$memberData->id)->get();
    	
    	if(isset($cartItems) && count($cartItems)){
    		foreach($cartItems as $cart){
    			$itemsByType = itemByTypeHelper($cart);
				$cartTotal = $cartTotal + $itemsByType['total'];
    		}
    	}

    	return $cartTotal;
    }

    public function paypalSuccessUrl(Request $request){

    	$memberData              = Auth::guard('member')->user();

    	$cartItems               = Cart::where('member_id',$memberData->id)->get();

    	$orderProduct            = OrderProduct::where('cart_id',$cartItems[0]->id)->first();

    	$order                   = Order::find($orderProduct->order_id);

    	$order->payment_status   = 'completed';

        $order->invoice_no       =  $order->id.time();
        
    	if($order->save()){
    		$this->orderProductTypeWiseUpdate($order);
            
            // Email send for admin
            Mail::to('allmusicallartist@outlook.com')->send(new OrderNotificationForAdmin($order)); 

            // Email Send For customer
            Mail::to($memberData->email)->send(new OrderNotificationForCustomer($order)); 
            
    		Cart::where('member_id',$memberData->id)->delete();
    	}
    	return view('frontend.checkout.payment-success');
    }

	
	public function paypalCancelUrl(Request $request){
	   
       $memberData               = Auth::guard('member')->user();

        $cartItems               = Cart::where('member_id',$memberData->id)->get();

        if( isset( $cartItems[0]->id ) )
        {
            $orderProduct            = OrderProduct::where('cart_id',$cartItems[0]->id)->first();

            $order                   = Order::find($orderProduct->order_id);

            $order->payment_status   = 'cancel';

            // $order->invoice_no       =  $order->id.time();
            
            if($order->save()){
                Cart::where('member_id',$memberData->id)->delete();
            }
            
            return view('frontend.checkout.payment-cancel');    
        }
        else{
            return view('frontend.checkout.payment-cancel');
        }
        
	}

	public function orderProductTypeWiseUpdate($data){
		$orderProductData = OrderProduct::where('order_id',$data->id)->get();
		// dd($orderProductData);
		if(isset($orderProductData) && count($orderProductData)){
			foreach($orderProductData as $orderP)
            {
				if($orderP->type == 'membership')
                {
					$member = Member::find(Auth::guard('member')->user()->id);
					$member->status = 1;
                    if(isset($orderP->member_type_id))
                    {
                        $member->membership_type_id = $orderP->member_type_id;
                    }
					$member->save();
				}

                if($orderP->type == 'book_band_dj')
                {
                    $book = BookBandDj::find($orderP->product_id);
                    $book->order_status = 1;
                    $book->save();
                }

                if($orderP->type == 'event')
                {
                    $book = Event::find($orderP->product_id);
                    $book->order_status = 1;
                    $book->save();
                }

                if($orderP->type == 'classified_buy')
                {
                    $book = Product::find($orderP->product_id);
                    $book->order_status = 1;
                    $book->save();
                }

                if($orderP->type == 'classified_sell')
                {
                    $book = Product::find($orderP->product_id);
                    $book->order_status = 1;
                    $book->save();
                }

                if($orderP->type == 'cd_buy')
                {
                    $book = Product::find($orderP->product_id);
                    $book->order_status = 1;
                    $book->save();
                }

                 if($orderP->type == 'cd_sell')
                {
                    $book = Product::find($orderP->product_id);
                    $book->order_status = 1;
                    $book->save();
                }
			}
		}
	}


    public function classifiedServiceBuy(ClassifiedServiceRequest $request, $alias)
    {
      
      $service             = $this->productService->getProductFromAlias($alias);
      
      $member              = Auth::guard('member')->user();

      try {
            DB::beginTransaction();

            $checkAlreadyExist     = ServiceOrder::where('service_id',$service->id)->where('member_id',$member->id)->where('status',0)->first(); 

            if(isset($checkAlreadyExist))
            {
                 return redirect()->back()->withMessage('Your Previous enquiry has been in pending status!');
            }
            else
            {
                $order                 = new ServiceOrder();

                $order->service_id     = $service->id;

                $order->member_id      = $member->id;

                $order->service_code   = time();

                $order->order_date     = date('Y-m-d');

                $order->name_of_owner  = $request->name_of_owner;

                $order->dba            = $request->dba;

                $order->address        = $request->address;

                $order->city           = $request->city;

                $order->state          = $request->state;

                $order->zip            = $request->zip;

                $order->phone_no       = $request->phone_no;

                $order->cell_phone     = $request->cell_phone;

                $order->fax            = $request->fax;

                $order->website        = $request->website;

                $order->email          = $request->email;

                $order->comments       = $request->comments;

                $order->total_amount   = $service->price;

                $order->payment_method = $request->payment_method;

                $order->payment_status = 'pending';

                $order->status = 0;

                if($order->save()){

                    DB::commit();
                    
                     // Email send for admin
                    Mail::to('allmusicallartist@outlook.com')->send(new OrderClassifiedServiceNotificationForAdmin($order));

                   // Mail::to('pawan@mapleleapgroups.com')->send(new OrderClassifiedServiceNotificationForAdmin($order)); 

                    if( isset($service->member_id) )
                    {
                        $memberData = Member::find($service->member_id);
                         // Email Send For customer
                        Mail::to($memberData->email)->send(new OrderClassifiedServiceNotificationForCustomer($order)); 
   
                    }
                   
                    return redirect()->back()->withMessage('Your inquiry has been sent successfully!');

                }    
            }
            

         } catch (UserNotFoundException $e) {
             DB::rollback();
            return redirect()->back()->withErrors('Unable to to register please try again.')->withInput($request->all());

        }  
    }


     public function classifiedServicePaypalSuccessUrl(Request $request){

        $memberData              = Auth::guard('member')->user();

        $order                   = ServiceOrder::where('member_id',$memberData->id)->where('status',0)->first();

        $order->payment_status   = 'completed';

        $order->invoice_no       =  $order->id.time();
        
        $order->status           = 1;

        if($order->save())
        {
              // Email send for admin
            Mail::to('allmusicallartist@outlook.com')->send(new OrderClassifiedServiceNotificationForAdmin($order)); 

            // Email Send For customer
            Mail::to($memberData->email)->send(new OrderClassifiedServiceNotificationForCustomer($order)); 

            return view('frontend.checkout.payment-success');
        }
    }

    
    public function classifiedServicePaypalCancelUrl(Request $request){
       
        $memberData              = Auth::guard('member')->user();

        $order                   = ServiceOrder::where('member_id',$memberData->id)->where('status',0)->first();

        $order->status           = 2;

        if($order->save())
        {
        
            return view('frontend.checkout.payment-cancel');
        }
    }


 }
