<?php 

namespace App\Music\Repositories\MemberVideo;

interface MemberVideoInterface
{
    public function save($id, $request);

    public function find($id);
}

