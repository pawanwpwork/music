<?php 

namespace App\Music\Services\MemberPhoto;

use App\Music\Repositories\MemberPhoto\MemberPhotoInterface;

class MemberPhotoService
{
    public function __construct(MemberPhotoInterface $memberPhoto)
    {
        $this->memberPhoto = $memberPhoto;
    }

    public function save($request)
    {
        try {
            $response = $this->memberPhoto->save($id = null, $request);
            activity()->log(sprintf('Member Photo created successfully of id: %s by user : %s', authGuardData('member')->first_name, authGuardData('member')->first_name));

            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Member Photo by user : %s', authGuardData('member')->id));

            return null;
        }
    }

    public function update($id, $request)
    {
        try {
            $this->memberPhoto->save($id, $request);
            activity()->log(
                sprintf(
                    'Membership Photo updated successfully :by user: %s',
                    '',
                    authGuardData('member')->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update Member Photo of id : %s by user : %s', $id, authGuardData('member')->id));

            return null;
        }
    }

    public function find($id){
        $photo = $this->memberPhoto->find($id);
        return $photo;
    }
}
