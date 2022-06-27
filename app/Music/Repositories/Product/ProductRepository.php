<?php 
namespace App\Music\Repositories\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function save($id, $request)
    {
        if ($id) {
            $product               = $this->find($id);
            $request["updated_by"] = auth()->user()->id;
            // $request['alias']      = $product->alias;
            if($request['image'] != $product->image){
                $oldPath    = storage_path('app/' . $product->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
                $image_name = imageUploadPost( isset($request['image']) ? $request['image'] : null, "product");
            }
            else{
                $image_name = $request['image'];
            }


            if($request['back_image'] != $product->back_image){
                $oldBackPath    = storage_path('app/' . $product->back_image);
                if (File::exists($oldBackPath)) {
                    File::delete($oldBackPath);
                }
                $back_image_name = imageUploadPost( isset($request['back_image']) ? $request['back_image'] : null, "product");
            }
            else{
                $back_image_name = $request['back_image'];
            }
            // dd(date('Y-m-d',strtotime($request['date_available'])));
            $request['image'] = $image_name;
            $request['back_image']  = $back_image_name;
            $request['category_ids'] = $request['category_id'];

            if(isset($request['date_available'])){
                $request['date_available'] = databaseDateFormat($request['date_available']);
            }

            if(isset($request['date_end'])){
                $request['date_end'] = databaseDateFormat($request['date_end']);
            }



            if(count($request['category_id']) > 0){
                $product->category()->sync($request['category_id']);
            }

            // dd($request);
            
            return $product->update($request);
        }

        $image_name = imageUploadPost( isset($request['image']) ? $request['image'] : null, "product");
        
        $back_image_name = imageUploadPost( isset($request['back_image']) ? $request['back_image'] : null, "product");

        if(auth()->user() != null){
            $request["created_by"] = auth()->user()->id;
            $request["add_user_type"] = 'admin';
        }
        
        $request['alias'] = unique_slug($request['name'],'products');
        
        $request['image']  = $image_name;
        
        $request['back_image']  = $back_image_name;

        if(isset($request['date_available'])){
            $request['date_available'] = databaseDateFormat($request['date_available']);
        }

        if(isset($request['date_end'])){
            $request['date_end'] = databaseDateFormat($request['date_end']);
        }
        
        $product = $this->product->create($request);
        
        if(count($request['category_id']) > 0){
            $product->category()->sync($request['category_id']);
        }

        return $product;
    }

    public function find($id)
    {
        return $this->product->with('category','member')->findOrFail($id);
    }

    public function getProductFromAlias($alias)
    {
        return $this->product->with('category')->where('alias', $alias)->first();
    }

    public function findAll($filters = [], $status = 1){
        
        $results = $this->product->where('order_status',1)->orderBy('id','desc')->when(array_filter($filters), function($query) use ($filters){
            if(array_key_exists('name', $filters)){
                $query->where('name', 'like','%' . $filters['name'] . '%');
            }
            if(array_key_exists('model', $filters)){
                $query->where('model', 'like','%' . $filters['model'] . '%');
            }
            if(array_key_exists('price', $filters)){
                $query->where('price', 'like','%' . $filters['price'] . '%');
            }
            if(array_key_exists('sku', $filters)){
                $query->where('sku', 'like','%' . $filters['sku'] . '%');
            }
            if(array_key_exists('quantity', $filters)){
                $query->where('quantity', 'like','%' . $filters['quantity'] . '%');
            }

             if(array_key_exists('category_id', $filters)){
               $query->whereHas('category', function ($q) use ($filters) {
                    $q->where('categories.id',$filters['category_id']);
                });
            }

            if(array_key_exists('status', $filters)){
                $query->where('status', $filters['status']);
            }
            return $query;
        })->get();

        return $results;
    }

    public function getproductData()
    {
        $product = $this->product->get();
        return $product;
    }

    public function delete($id)
    {
        $product = $this->find($id);

        return $product->delete();
    }


    public function saveCdData($request)
    {
        $image_name = imageUploadPost( isset($request['image']) ? $request['image'] : null, "product");
        $back_image_name = imageUploadPost( isset($request['back_image']) ? $request['back_image'] : null, "product");

        if(authGuardData('member') != null){
            $request["member_id"] = authGuardData('member')->id;
            $request["add_user_type"] = 'member';
        }
        
        $request['alias'] = unique_slug($request['name'],'products');
        
        $request['image']  = $image_name;

        $request['back_image']  = $back_image_name;
        
        $product = $this->product->create($request);
        
      
        $product->category()->sync(1);
      

        return $product;
    }


    public function saveClassifiedData($request)
    {

        $image_name = imageUploadPost( isset($request['image']) ? $request['image'] : null, "product");
        
       if(authGuardData('member') != null){
            $request["member_id"] = authGuardData('member')->id;
            $request["add_user_type"] = 'member';
        }
        
        $request['alias'] = unique_slug($request['name'],'products');
        
        $request['image']  = $image_name;
        
        if(isset($request['date_available'])){
            $request['date_available'] = databaseDateFormat($request['date_available']);
        }

        if(isset($request['date_end'])){
            $request['date_end'] = databaseDateFormat($request['date_end']);
        }
        
        // dd($request);
        $product = $this->product->create($request);
        
        if(count($request['category_id']) > 0){
            $product->category()->sync($request['category_id']);
        }


        return $product;
    }
}
