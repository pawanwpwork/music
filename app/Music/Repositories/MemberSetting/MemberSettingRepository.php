<?php 
namespace App\Music\Repositories\MemberSetting;

use App\Models\MembershipSettings;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class MemberSettingRepository implements MemberSettingInterface
{
    protected $memberSetting;

    public function __construct(MembershipSettings $memberSetting)
    {
        $this->memberSetting = $memberSetting;
    }

    public function save($id, $request)
    {
        if ($id) {
            
            if(!isset($request['full_access'])){
                $request['full_access'] = 0;
            }
            if(!isset($request['home_access'])){
                $request['home_access'] = 0;
            }
            if(!isset($request['about_us'])){
                $request['about_us'] = 0;
            }
            if(!isset($request['view_event'])){
                $request['view_event'] = 0;
            }
            if(!isset($request['post_event'])){
                $request['post_event'] = 0;
            }
            if(!isset($request['request_to_book_band'])){
                $request['request_to_book_band'] = 0;
            }
            if(!isset($request['post_classified'])){
                $request['post_classified'] = 0;
            }
            if(!isset($request['view_classified'])){
                $request['view_classified'] = 0;
            }
            if(!isset($request['cd_store'])){
                $request['cd_store'] = 0;
            }
            if(!isset($request['cd_sell'])){
                $request['cd_sell'] = 0;
            }
            if(!isset($request['musian_search'])){
                $request['musian_search'] = 0;
            }
            if(!isset($request['radio_submit'])){
                $request['radio_submit'] = 0;
            }
            if(!isset($request['radio_listen'])){
                $request['radio_listen'] = 0;
            }
            if(!isset($request['contact_us'])){
                $request['contact_us'] = 0;
            }

            $setting = $this->find($id);
            return $setting->update($request);
        }

        $memberSetting = $this->memberSetting->create($request);

        return $siteSetting;
    }

    public function getFirst($memberType)
    {
        return $this->memberSetting->where('membership_type_id',$memberType)->first();
    }

    public function find($id)
    {
        return $this->memberSetting->find($id);
    }

    public function getMemberSettingData()
    {
        return $this->memberSetting->get();
    }
}
