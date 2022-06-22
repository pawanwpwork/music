<?php 

namespace App\Music\Repositories\MemberInstrument;

interface MemberInstrumentInterface
{
    public function save($id, $request);

    public function find($id);
}

