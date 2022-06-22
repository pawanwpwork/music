<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderImageRequest;
use Illuminate\Http\Request;
use App\Music\Services\SliderImage\SliderImageService;
use File;
use Response;

class SliderImageController extends Controller
{
    protected $sliderImage;

    public function __construct(
        SliderImageService $sliderImageService
    ) {
        $this->middleware('auth',['except' => ['storageLocationFileDisplay']]);
        $this->sliderImageService          = $sliderImageService;
    }

    public function index(Request $request)
    {
    	$sliders = $this->sliderImageService->getSiteData();
        return view('backend.components.slider-image.list',compact('sliders'));
    }

    public function create(){
        return view('backend.components.slider-image.create');
    }

    public function storageLocationFileDisplay($id)
    {
        $sliderImage = $this->sliderImageService->find($id);
        $path        = storage_path('app/' . $sliderImage->image);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function store(SliderImageRequest $request)
    {
        $response = $this->sliderImageService->save($request->all());
        
        if ($response) {
            return redirect()->route('admin.slider-image.edit',$response->id)->withMessage('Successfully created slider image');
        } else {
            return redirect()->back()->withErrors('Unable to save slider image. Please try again')->withInput($request->all());
        }
    }

    public function edit($id){
       $setting = $this->sliderImageService->find($id);
       return view('backend.components.slider-image.edit',compact('setting'));
    }

    public function update(SliderImageRequest $request, $id)
    {
        if ($this->sliderImageService->update($id, $request->all())) {
            return redirect()->back()->withMessage('Successfully updated slider image');
        } else {
            return redirect()->back()->withErrors('Unable to update slider-image. Please try again')->withInput($request->all());
        }
    }


    public function getModalDelete($id = null)
    {
        $model         = 'sliderImage';
        $confirm_route = $error = null;
        try {
            $review       = $this->sliderImageService->find($id);
            $confirm_route = route('admin.slider-image.delete', $review->id);
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
            response()->json(['view' => $view]);
        } catch (UserNotFoundException $e) {
            dd($e->getMessage());
        }  
    }

    public function destroy($id = null)
    {
        if ($this->sliderImageService->delete($id)) {
            return redirect()->route('admin.slider-image.list')->withMessage('Successfully deleted slider image');
        } else {
            return redirect()->back()->withErrors('Unable to delete slider image Please try again');
        }
    }

}
