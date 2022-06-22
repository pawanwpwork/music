<?php 

namespace App\Music\Services\MemberVideo;

use App\Music\Repositories\MemberVideo\MemberVideoInterface;

class MemberVideoService
{
    public function __construct(MemberVideoInterface $memberVideo)
    {
        $this->memberVideo = $memberVideo;
    }

    public function save($request)
    {
        try {
            $response = $this->memberVideo->save($id = null, $request);
            activity()->log(sprintf('Member Video created successfully of id: %s by user : %s', authGuardData('member')->first_name, authGuardData('member')->first_name));

            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Member Video by user : %s', authGuardData('member')->id));

            return null;
        }
    }

    public function update($id, $request)
    {
        try {
            $this->memberVideo->save($id, $request);
            activity()->log(
                sprintf(
                    'Membership Video updated successfully :by user: %s',
                    '',
                    authGuardData('member')->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update Member Video of id : %s by user : %s', $id, authGuardData('member')->id));

            return null;
        }
    }

    public function find($id){
        $video = $this->memberVideo->find($id);
        return $video;
    }
}
