<?php 
namespace App\Music\Repositories\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class CategoryRepository implements CategoryInterface
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category      = $category;
    }

    public function save($id, $request)
    {
        if ($id) {
            $category               = $this->find($id);
            $request["updated_by"] = auth()->user()->id;
          
            $request['alias'] = unique_slug($request['name'],'categories',$category->id);
          
            if($request['image'] != $category->image){
                $oldPath    = storage_path('app/' . $category->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
                $image_name = imageUploadPost( isset($request['image']) ? $request['image'] : null, "category",1135,643 );
            }
            else{
                $image_name = $request['image'];
            }
            $request['image'] = $image_name;
            return $category->update($request);
        }
        $image_name = imageUploadPost( isset($request['image']) ? $request['image'] : null, "category");
        $request["created_by"] = auth()->user()->id;
       
        $request['alias'] = unique_slug($request['name'],'categories');
    
        $request['image']  = $image_name;
    
        $category = $this->category->create($request);

        return $category;
    }

    public function find($id)
    {
        return $this->category->findOrFail($id);
    }

 
    public function getCategoryData()
    {
       $category = $this->category->where('status',1)->get();
        return $category;
    }

    public function delete($id)
    {
        $category = $this->find($id);

        return $category->delete();
    }
}
