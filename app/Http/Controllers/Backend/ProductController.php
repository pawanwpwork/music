<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Music\Services\Product\ProductService;
use App\Music\Services\Category\CategoryService;
use File;
use Response;
use App\Mail\SendCustomerPublisedAd;
use Mail;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct( ProductService $productService, CategoryService $categoryService) {
        $this->middleware('auth',['except' => ['storageLocationFileDisplay','storageLocationFileBackDisplay']]);
        $this->productService    = $productService;
        $this->categoryService   = $categoryService;
    }

    public function index(Request $request)
    {
        $filters = [];
        
        if( isset( $request->name ) )
        {
            $filters['name']        =  $request->name ?? '';    
        }

        if( isset( $request->model ) )
        {
            $filters['model']        =  $request->model ?? '';    
        }

        if( isset( $request->sku ) )
        {
            $filters['sku']        =  $request->sku ?? '';    
        }

        if( isset( $request->price ) )
        {
            $filters['price']        =  $request->price ?? '';    
        }

        if( isset( $request->status ) )
        {
            $filters['status']        =  $request->status ?? '';    
        }

        if( isset( $request->category_id ) )
        {
            $filters['category_id']        =  $request->category_id ?? '';    
        }


    	$products               =  $this->productService->findAll($filters);
        // dd($products);
        $categories             = $this->categoryService->getCategoryData();

        return view('backend.components.product.list',compact('products','categories'));
    }

    public function create(){
    	$products   = $this->productService->getProductData();
    	$categories = $this->categoryService->getCategoryData();
        return view('backend.components.product.create',compact('products', 'categories'));
    }

    public function store(ProductRequest $request)
    {
        $request                 = $request->all();
        $request['order_status'] = 1;
        $response = $this->productService->save($request);
        
        if ($response) {
            return redirect()->route('admin.product.edit',$response->id)->withMessage('Successfully created Product!');
        } else {
            return redirect()->back()->withErrors('Unable to save product. Please try again')->withInput($request->all());
        }
    }

    public function edit($id){
       $product = $this->productService->find($id);
       $products = $this->productService->getProductData();
       $categories = $this->categoryService->getCategoryData();
       return view('backend.components.product.edit',compact('product','products', 'categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        if ($this->productService->update($id, $request->all())) {
            return redirect()->back()->withMessage('Successfully updated Category');
        } else {
            return redirect()->back()->withErrors('Unable to update product. Please try again')->withInput($request->all());
        }
    }
 

    public function getModalDelete($id = null)
    {
        $model         = 'product';
        $confirm_route = $error = null;
        try {
            $product       = $this->productService->find($id);
            $confirm_route = route('admin.product.delete', $product->id);
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
            response()->json(['view' => $view]);
        } catch (UserNotFoundException $e) {
            dd($e->getMessage());
        }  
    }

    public function destroy($id = null)
    {
        if ($this->productService->delete($id)) {
            return redirect()->route('admin.product.list')->withMessage('Successfully deleted product!');
        } else {
            return redirect()->back()->withErrors('Unable to delete product. Please try again');
        }
    }

    public function storageLocationFileDisplay($id)
    {
        $product = $this->productService->find($id);
        $path    = storage_path('app/' . $product->image);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }


    public function storageLocationFileBackDisplay($id)
    {
        $product = $this->productService->find($id);
        $path    = storage_path('app/' . $product->back_image);
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
            $product = $this->productService->find($id);
            if ($product->status == 1) {
                $product->status = 0;
                $message         = trans_choice('product.success.status_unpublish', 1, ['count' => 1]);
            } else {
                $product->status = 1;
                if($product->add_user_type == 'member'){
                    Mail::to($product->member->email)->send(new SendCustomerPublisedAd($product));     
                }
                $message         = trans_choice('product.success.status_publish', 1, ['count' => 1]);
            }

            if ($product->save()) {
                return redirect()->route('admin.product.list')->withMessage($message);
            }
        } catch (Exception $e) {
            return redirect()->route('admin.product.list')->withMessage($e->getMessge());
        }
    }

    public function show($id){
       $product = $this->productService->find($id);
       return view('backend.components.product.show',compact('product'));
    }
}
