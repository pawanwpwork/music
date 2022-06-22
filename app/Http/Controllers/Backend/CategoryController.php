<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Music\Services\Category\CategoryService;
use File;
use Response;

class CategoryController extends Controller
{
    protected $categoryService;


    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(
        CategoryService $categoryService
    ) {
        $this->middleware('auth',['except' => ['storageLocationFileDisplay']]);
        $this->categoryService           = $categoryService;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$categories = $this->categoryService->getCategoryData();
        return view('backend.components.category.list',compact('categories'));
    }

    public function create(){
    	$categories = $this->categoryService->getCategoryData();
        return view('backend.components.category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
      
        $response = $this->categoryService->save($request->all());
        
        if ($response) {
            return redirect()->route('admin.category.edit',$response->id)->withMessage('Successfully created Category');
        } else {
            return redirect()->back()->withErrors('Unable to save Category. Please try again')->withInput($request->all());
        }
    }

    public function edit($id){
       $category = $this->categoryService->find($id);
       $categories = $this->categoryService->getCategoryData();
       return view('backend.components.category.edit',compact('category','categories'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest|Request $request
     * @param                         $projectId
     * @param  int                    $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        if ($this->categoryService->update($id, $request->all())) {
            return redirect()->back()->withMessage('Successfully updated Category');
        } else {
            return redirect()->back()->withErrors('Unable to update Category. Please try again')->withInput($request->all());
        }
    }
 

    public function getModalDelete($id = null)
    {
        $model         = 'category';
        $confirm_route = $error = null;
        try {
            $category       = $this->categoryService->find($id);
            $confirm_route = route('admin.category.delete', $category->id);
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
            response()->json(['view' => $view]);
        } catch (UserNotFoundException $e) {
            dd($e->getMessage());
        }  
    }

    public function destroy($id = null)
    {
        if ($this->categoryService->delete($id)) {
            return redirect()->route('admin.category.list')->withMessage('Successfully deleted Category');
        } else {
            return redirect()->back()->withErrors('Unable to delete category. Please try again');
        }
    }


    /**
     * Fetch image path from storage
     * @param $id
     * @return mixed
     */
    public function storageLocationFileDisplay($id)
    {
        $category = $this->categoryService->find($id);
        $path    = storage_path('app/' . $category->image);
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
            $category = $this->categoryService->find($id);
            if ($category->status == 1) {
                $category->status = 0;
                $message           = trans_choice('category.success.status_unpublish', 1, ['count' => 1]);
            } else {
                $category->status = 1;
                $message           = trans_choice('category.success.status_publish', 1, ['count' => 1]);
            }

            if ($category->save()) {
                return redirect()->route('admin.category.list')->withMessage($message);
            }
        } catch (Exception $e) {
            return redirect()->route('admin.category.list')->withMessage($e->getMessge());
        }
         
    }
}
