<?php

namespace App\Http\Controllers\Frotend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;

class ProductReviewController extends Controller
{
    public function __construct(){
      $this->middleware('auth:member');
   }

   public function postProductReview($id,Request $request){

		$productId = decrypt($id);
		
		$checkProductReview = ProductReview::where('product_id',$productId)->where('member_id',authGuardData('member')->id)->get();
		
		if(isset($checkProductReview) && count($checkProductReview)){
			return redirect()->back()->withMessage('You already submit your review!');
		}

		$review = new ProductReview();
		$review->product_id = $productId;
		$review->member_id = authGuardData('member')->id;
		$review->review = $request->review;
		$review->email = $request->review_email;
		$review->full_name = $request->review_name;
      $review->rating = $request->rating;
		
      if($review->save()){
			return redirect()->back()->withMessage('Thank you for your review. Successfully submit your review.');
		}

   }
}
