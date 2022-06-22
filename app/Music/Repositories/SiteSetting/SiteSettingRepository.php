<?php 
namespace App\Music\Repositories\SiteSetting;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class SiteSettingRepository implements SiteSettingInterface
{
    protected $siteSetting;

    public function __construct(SiteSetting $siteSetting)
    {
        $this->siteSetting = $siteSetting;
    }

    public function save($id, $request)
    {
        if ($id) {
            $siteSetting    = $this->find($id);
            if($request['logo'] != $siteSetting->logo){
                $oldPath    = storage_path('site-setting/' . $siteSetting->logo);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
                $image_name = imageUploadPost( isset($request['logo']) ? $request['logo'] : null, "site-setting",1135,643 );
            }
            else{
                $image_name = $request['logo'];
            }
            $request['logo'] = $image_name;
            return $siteSetting->update($request);
        }
        $image_name = imageUploadPost( isset($request['logo']) ? $request['logo'] : null, "site-setting");
        $request['logo']  = $image_name;
        $siteSetting = $this->siteSetting->create($request);

        return $siteSetting;
    }

    public function find($id)
    {
        return $this->siteSetting->findOrFail($id);
    }

    public function getFirst()
    {
        return $this->siteSetting->first();
    }

    public function getSiteData()
    {
        $siteSetting = $this->siteSetting->get();
        return $siteSetting;
    }

    public function delete($id)
    {
        $siteSetting = $this->find($id);

        return $siteSetting->delete();
    }
}
