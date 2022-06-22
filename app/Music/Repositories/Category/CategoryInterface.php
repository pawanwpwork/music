<?php 

namespace App\Music\Repositories\Category;

interface CategoryInterface
{
    public function save($id, $request);

    public function getCategoryData();

    public function find($id);

    public function delete($id);
}

