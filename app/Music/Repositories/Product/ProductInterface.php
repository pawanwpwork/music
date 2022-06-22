<?php 

namespace App\Music\Repositories\Product;

interface ProductInterface
{
    public function save($id, $request);

    public function getProductData();

    public function find($id);

    public function getProductFromAlias($alias);

    public function findAll($filters = [], $status = 1);

    public function delete($id);

    public function saveCdData($request);

    public function saveClassifiedData($request);
}

