<?php 
namespace App\Music\Repositories\SliderImage;

use App\Models\SliderImage;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class SliderImageRepository implements SliderImageInterface
{
    protected $sliderImage;

    public function __construct(SliderImage $sliderImage)
    {
        $this->sliderImage = $sliderImage;
    }

    public function save($id, $request)
    {
        if ($id) {
            $sliderImage    = $this->find($id);
            if($request['image'] != $sliderImage->image){
                $oldPath    = storage_path('slider-image/' . $sliderImage->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
                $image_name = imageUploadPost( isset($request['image']) ? $request['image'] : null, "slider-image",1135,643 );
            }
            else{
                $image_name = $request['image'];
            }
            $request['image'] = $image_name;
            return $sliderImage->update($request);
        }
        $image_name = imageUploadPost( isset($request['image']) ? $request['image'] : null, "slider-image");
        $request['image']  = $image_name;
        $sliderImage = $this->sliderImage->create($request);

        return $sliderImage;
    }

    public function find($id)
    {
        return $this->sliderImage->findOrFail($id);
    }

    public function getSiteData()
    {
        $sliderImage = $this->sliderImage->get();
        return $sliderImage;
    }

    public function delete($id)
    {
        $sliderImage = $this->find($id);

        return $sliderImage->delete();
    }
}
