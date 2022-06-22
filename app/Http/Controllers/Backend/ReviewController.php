<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Music\Services\Review\ReviewService;
use File;
use Response;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(
        ReviewService $reviewService
    ) {
        $this->middleware('auth',['except' => ['storageLocationFileDisplay']]);
        $this->reviewService           = $reviewService;
    }

    public function index(Request $request)
    {
    	$reviews = $this->reviewService->getreviewData();
        
        return view('backend.components.review.list',compact('reviews'));
    }

    public function getModalDelete($id = null)
    {
        $model         = 'review';
        $confirm_route = $error = null;
        try {
            $review       = $this->reviewService->find($id);
            $confirm_route = route('admin.review.delete', $review->id);
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
            response()->json(['view' => $view]);
        } catch (UserNotFoundException $e) {
            dd($e->getMessage());
        }  
    }

    public function destroy($id = null)
    {
        if ($this->reviewService->delete($id)) {
            return redirect()->route('admin.review.list')->withMessage('Successfully deleted review');
        } else {
            return redirect()->back()->withErrors('Unable to delete review. Please try again');
        }
    }

    public function getModalStatus($id = null)
    {
        $model         = 'review.status';
        $confirm_route = $error = null;
        try {
            $review       = $this->reviewService->find($id);
            $confirm_route = route('admin.review.status', $review->id);
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
            response()->json(['view' => $view]);
        } catch (UserNotFoundException $e) {
            dd($e->getMessage());
        }  
    }

    public function changeStatus($id = null)
    {
        if ($this->reviewService->changeStatus($id)) {
            return redirect()->route('admin.review.list')->withMessage('Successfully update review status!');
        } else {
            return redirect()->back()->withErrors('Unable to update review status. Please try again');
        }
    }

}
