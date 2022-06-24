<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceOrder;
use App\Models\Member;
use Mail;
use App\Mail\SendInvoiceToCustomer;

class ServiceOrderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function serviceEnquiry(){
        $services = ServiceOrder::whereHas('product')->with('member')->get();
        return view('backend.components.order.service-order',compact('services'));
    }

    public function serviceEnquiryDetail($enquiryID){
        $service = ServiceOrder::find($enquiryID);
        return view('backend.components.order.service-order-detail',compact('service'));
    }

    public function serviceSatusUpdate($id)
    {
        $service = ServiceOrder::find($id);

        if($service->status == 1)
        {
            $service->status = 0;
            if( $service->save() )
            {
                return redirect()->back()->withMessage('Status pending successfully updated.');
            }
        }
        if($service->status == 0)
        {

            $service->status = 1;
            if( $service->save() )
            {
                // dd($service);
                return redirect()->back()->withMessage('Status Approved successfully updated.');
            }
        }
    }

}
