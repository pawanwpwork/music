<?php 

namespace App\Music\Repositories\MusicCategory;

interface MusicCategoryInterface
{
    public function save($id, $request);

    public function getMusicCategoryData();

    public function find($id);

    public function delete($id);
}

