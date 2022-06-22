<?php 

namespace App\Music\Services\MemberSetting;

use App\Music\Repositories\MemberSetting\MemberSettingInterface;

class MemberSettingService
{
    public function __construct(MemberSettingInterface $memberSetting)
    {
        $this->memberSetting = $memberSetting;
    }

    public function save($request)
    {
        try {
            $response = $this->memberSetting->save($id = null, $request);
            activity()->log(sprintf('Member Setting created successfully of id: %s by user : %s', auth()->user()->first_name, getUserNameById(auth()->user()->id)->first_name));

            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Member Setting by user : %s', auth()->user()->id));

            return null;
        }
    }

    public function getFirst($memberType)
    {
        return $this->memberSetting->getFirst($memberType);
    }

    public function find($id)
    {
        return $this->memberSetting->find($id);
    }

    public function getMemberSettingData()
    {
        return $this->memberSetting->getMemberSettingData();
    }

    public function update($id, $request)
    {
        try {
            $this->memberSetting->save($id, $request);
            activity()->log(
                sprintf(
                    'Membership Setting updated successfully :by user: %s',
                    '',
                    getUserNameById(auth()->user()->id)->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update Membership of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }
}
