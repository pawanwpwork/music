<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSettingRequest;
use Illuminate\Http\Request;
use App\Music\Services\SiteSetting\SiteSettingService;
use File;
use Response;

class SiteSettingController extends Controller
{
    protected $siteSettingService;

    public function __construct(
        SiteSettingService $siteSettingService
    ) {
        $this->middleware('auth',['except' => ['storageLocationFileDisplay']]);
        $this->siteSettingService          = $siteSettingService;
    }

    public function index(Request $request)
    {
        $setting = $this->siteSettingService->getFirst();
    	$settings = $this->siteSettingService->getSiteData();
        return view('backend.components.site-setting.list',compact('settings', 'setting'));
    }

    public function create(){
        
        $setting = $this->siteSettingService->getFirst();
        
        if(!$setting){
            $products = $this->siteSettingService->getSiteData();
            return view('backend.components.site-setting.create',compact('products'));
        }

    	return view('backend.components.site-setting.edit',compact('setting'));
    }

    public function storageLocationFileDisplay($id)
    {
        $setting = $this->siteSettingService->find($id);
        $path    = storage_path('app/' . $setting->logo);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function store(SiteSettingRequest $request)
    {
        $response = $this->siteSettingService->save($request->all());
        
        if ($response) {
            return redirect()->back()->withMessage('Successfully created site setting');
        } else {
            return redirect()->back()->withErrors('Unable to save site setting. Please try again')->withInput($request->all());
        }
    }

    public function edit($id){
       $setting = $this->siteSettingService->find($id);
       return view('backend.components.site-setting.edit',compact('setting'));
    }

    public function update(SiteSettingRequest $request, $id)
    {
        if ($this->siteSettingService->update($id, $request->all())) {
            return redirect()->back()->withMessage('Successfully updated site setting');
        } else {
            return redirect()->back()->withErrors('Unable to update site-setting. Please try again')->withInput($request->all());
        }
    }


    // public function getModalDelete($id = null)
    // {
    //     $model         = 'siteSetting';
    //     $confirm_route = $error = null;
    //     try {
    //         $review       = $this->siteSettingService->find($id);
    //         $confirm_route = route('admin.site-setting.delete', $review->id);
    //         return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
    //         response()->json(['view' => $view]);
    //     } catch (UserNotFoundException $e) {
    //         dd($e->getMessage());
    //     }  
    // }

    // public function destroy($id = null)
    // {
    //     if ($this->siteSettingService->delete($id)) {
    //         return redirect()->route('admin.site-setting.list')->withMessage('Successfully deleted site setting');
    //     } else {
    //         return redirect()->back()->withErrors('Unable to delete site setting Please try again');
    //     }
    // }

}
