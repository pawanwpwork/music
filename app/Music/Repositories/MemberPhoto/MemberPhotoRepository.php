<?php 
namespace App\Music\Repositories\MemberPhoto;

use App\Models\MemberPhoto;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class MemberPhotoRepository implements MemberPhotoInterface
{
    protected $memberPhoto;

    public function __construct(MemberPhoto $memberPhoto)
    {
        $this->memberPhoto = $memberPhoto;
    }

    public function save($id, $request)
    {
        if ($id) {

            $photo             = imageUploadPost( isset($request['photo']) ? $request['photo'] : null, "photo");

            $request['member_id'] =  authGuardData('member')->id;

            $request['photo']  = $photo;

            return $memberPhoto->update($request);
        }

        $photo             = imageUploadPost( isset($request['photo']) ? $request['photo'] : null, "photo");

        $request['photo']  = $photo;

        $request['member_id'] =  authGuardData('member')->id;
        
        $memberPhoto       = $this->memberPhoto->create($request);

        return $memberPhoto;
    }


    public function find($id){
        $photo = $this->memberPhoto->find($id);
        return $photo;
    }
}
