<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RateSetting;

class RateSettingController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
    	$rate = RateSetting::first();
    	return view('backend.components.rate-setting.index',compact('rate'));
    }

    public function store(Request $request){
    	$rate = RateSetting::first();
    	if(isset($rate)){
    		$rate->update($request->all());
    	}
    	else{
    		RateSetting::create($request->all());
    	}

    	return redirect()->route('admin.rate-setting.index')->withMessage('Rate is successfully Update');
    }
}
