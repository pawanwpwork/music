<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Member;
use Mail;
use App\Mail\SendInvoiceToCustomer;
class OrderController extends Controller
{
    /**
     * BandDjAgeGroupController constructor.
     * @param BandDjAgeGroupService $bandDjAgeGroupService
     */
    public function __construct() {
        $this->middleware('auth');
    }


    public function orderPending(){
        // $orders = Order::where('payment_status','pending')->latest()->get();
        $orders = Order::where('payment_status','completed')->latest()->get();
        return view('backend.components.order.pending',compact('orders'));
    }

    public function orderSuccess(){
        $orders = Order::where('payment_status','completed')->latest()->get();
        return view('backend.components.order.success',compact('orders'));	
    }

    public function orderCancel(){
        $orders = Order::where('payment_status','cancel')->latest()->get();
        return view('backend.components.order.cancel',compact('orders'));	
    }

    public function orderDetails($order_id){
        $order = Order::where('order_id',$order_id)->first();
        return view('backend.components.order.details',compact('order'));    
    }

    public function orderInvoice($order_id){
        $order = Order::where('order_id',$order_id)->first();
        return view('backend.components.order.invoice',compact('order'));    
    }

    public function invoiceSendCustomer($order_id){
        $order = Order::where('order_id',$order_id)->first();
        $memberData = Member::find($order->member_id);
        Mail::to($memberData->email)->send(new SendInvoiceToCustomer($order)); 
        return redirect()->route('admin.order.details',$order->order_id)->withMessage('Successfully sent invoice to customer');
    }
}
