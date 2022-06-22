<?php 

namespace App\Music\Repositories\Review;

interface ReviewInterface
{
    public function save($id, $request);

    public function getReviewData();

    public function find($id);

    public function delete($id);
    
    public function changeStatus($id);
}

