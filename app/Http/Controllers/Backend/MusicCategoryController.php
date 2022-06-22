<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Music\Services\MusicCategory\MusicCategoryService;
use App\Http\Requests\MusicCategoryRequest;
use File;
use Response;

class MusicCategoryController extends Controller
{
    protected $musicCategory;

    public function __construct(
        MusicCategoryService $musicCategory
    ) {
        $this->middleware('auth',['except' => ['storageLocationFileDisplay']]);
        $this->musicCategory = $musicCategory;
    }

    public function index(Request $request)
    {   
    	$musicCategories = $this->musicCategory->getMusicCategoryData();
        
        return view('backend.components.music-category.list',compact('musicCategories'));
    }

    public function create(){
        return view('backend.components.music-category.create');
    }

    public function store(MusicCategoryRequest $request)
    {
        $response = $this->musicCategory->save($request->all());
        
        if ($response) {
            return redirect()->route('admin.music-category.edit',$response->id)->withMessage('Successfully created music category.');
        } else {
            return redirect()->back()->withErrors('Unable to save music category. Please try again')->withInput($request->all());
        }
    }

    public function edit($id){
       $musicCategory = $this->musicCategory->find($id);
       return view('backend.components.music-category.edit',compact('musicCategory'));
    }

    public function update(MusicCategoryRequest $request, $id)
    {
        if ($this->musicCategory->update($id, $request->all())) {
            return redirect()->back()->withMessage('Successfully updated music category.');
        } else {
            return redirect()->back()->withErrors('Unable to update music category. Please try again')->withInput($request->all());
        }
    }
 

    public function getModalDelete($id = null)
    {
        $model         = 'musicCategory';
        $confirm_route = $error = null;
        try {
            $musicCategory       = $this->musicCategory->find($id);
            $confirm_route = route('admin.music-category.delete', $musicCategory->id);
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
            response()->json(['view' => $view]);
        } catch (UserNotFoundException $e) {
            dd($e->getMessage());
        }  
    }

    public function destroy($id = null)
    {
        if ($this->musicCategory->delete($id)) {
            return redirect()->route('admin.music-category.list')->withMessage('Successfully deleted music category!');
        } else {
            return redirect()->back()->withErrors('Unable to delete music category. Please try again');
        }
    }

    public function storageLocationFileDisplay($id)
    {
        $musicCategory = $this->musicCategory->find($id);
        $path    = storage_path('app/' . $musicCategory->image);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    // change Status
    public function statusChange($id)
    {
        try {
            $musicCategory = $this->musicCategory->find($id);
            if ($musicCategory->status == 1) {
                $musicCategory->status = 0;
                $message           = trans_choice('music-category.success.status_unpublish', 1, ['count' => 1]);
            } else {
                $musicCategory->status = 1;
                $message           = trans_choice('music-category.success.status_publish', 1, ['count' => 1]);
            }

            if ($musicCategory->save()) {
                return redirect()->route('admin.music-category.list')->withMessage($message);
            }
        } catch (Exception $e) {
            return redirect()->route('admin.music-category.list')->withMessage($e->getMessge());
        }
         
    }
}
