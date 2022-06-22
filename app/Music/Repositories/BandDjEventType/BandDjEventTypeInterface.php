<?php 

namespace App\Music\Repositories\BandDjEventType;

interface BandDjEventTypeInterface
{
    public function save($id, $request);

    public function getBandDjEventTypeData();

    public function find($id);

    public function delete($id);
}

