<?php 

namespace App\Music\Repositories\MemberSetting;

interface MemberSettingInterface
{
    public function save($id, $request);

    public function getFirst($memberType);

    public function find($id);

    public function getMemberSettingData();

}

