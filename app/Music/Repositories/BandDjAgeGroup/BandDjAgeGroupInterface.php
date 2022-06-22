<?php 

namespace App\Music\Repositories\BandDjAgeGroup;

interface BandDjAgeGroupInterface
{
    public function save($id, $request);

    public function getBandDjAgeGroupData();

    public function find($id);

    public function delete($id);
}

