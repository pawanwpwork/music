<?php 

namespace App\Music\Repositories\BandDjBook;

interface BandDjBookInterface
{
    public function save($id, $request);

    public function getBandDjBookData();

    public function find($id);

    public function delete($id);

    public function bankBandDjPostsave($request);
}

