<?php 

namespace App\Music\Repositories\SliderImage;

interface SliderImageInterface
{
    public function save($id, $request);

    public function getSiteData();

    public function find($id);

    public function delete($id);
}

