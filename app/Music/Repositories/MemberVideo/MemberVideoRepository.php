<?php 
namespace App\Music\Repositories\MemberVideo;

use App\Models\MemberVideo;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class MemberVideoRepository implements MemberVideoInterface
{
    protected $memberVideo;

    public function __construct(MemberVideo $memberVideo)
    {
        $this->memberVideo = $memberVideo;
    }

    public function save($id, $request)
    {
        if ($id) {

            $video                = videoUploadPost( isset($request['video']) ? $request['video'] : null, "video");

            $request['member_id'] = authGuardData('member')->id;

            $request['video']     = $video;

            return $memberVideo->update($request);
        }

        $video                  = videoUploadPost( isset($request['video']) ? $request['video'] : null, "video");

        $request['video']       = $video;

        $request['member_id']   =  authGuardData('member')->id;
        
        $memberVideo            = $this->memberVideo->create($request);

        return $memberVideo;
    }


    public function find($id){
        $video = $this->memberVideo->find($id);
        return $video;
    }
}
