<?php 

namespace App\Music\Repositories\MemberPhoto;

interface MemberPhotoInterface
{
    public function save($id, $request);

    public function find($id);
}

