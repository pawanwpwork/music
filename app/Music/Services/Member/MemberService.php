<?php 

namespace App\Music\Services\Member;

use App\Music\Repositories\Member\MemberInterface;

class MemberService
{
    public function __construct(MemberInterface $memberInterface)
    {
        $this->memberInterface = $memberInterface;
    }

    public function save($request)
    {
        try {
            $response = $this->memberInterface->save($id = null, $request);
            activity()->log(sprintf('Member created successfully of id: %s by user : %s', $request['first_name'], getUserNameById(auth()->user()->id)->first_name));

            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Member by user : %s', auth()->user()->id));

            return null;
        }
    }

    public function signup($request){

        // try {
            $response = $this->memberInterface->signup($request);
            activity()->log(sprintf('Member Sinup successfully of id: %s by user : %s', $request['first_name'], $request['last_name']));

            return $response;
        // } catch (\Exception $e) {
        //     activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to Sinup Member by user : %s', 'self'));

        //     return null;
        // }

    }

    public function getMemberData()
    {
        return $this->memberInterface->getMemberData();
    }

    public function getMusicCategoryData()
    {
        return $this->memberInterface->getMusicCategoryData();
    }

    public function getGenreData()
    {
        return $this->memberInterface->getGenreData();
    }

    public function getMembershipTypeData()
    {
        return $this->memberInterface->getMembershipTypeData();
    }

    public function findAll($filters)
    {
        return $this->memberInterface->findAll($filters);
    }

    public function update($id, $request)
    {
        try {
            $this->memberInterface->save($id, $request);
            activity()->log(
                sprintf(
                    'Member updated successfully : %s by user: %s',
                    getNameByIdOfTable('members', $id)->first_name,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update Member of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function delete($id)
    {
        try {
            $this->memberInterface->delete($id);
            activity()->log(
                sprintf(
                    'Member Deleted successfully: %s by user: %s',
                    getNameByIdOfTable('members', $id)->first_name,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );
            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to delete Category of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function find($id)
    {
        return $this->memberInterface->find($id);
    }


    public function UpdateProfileImage($id, $request)
    {
        try {
            $this->memberInterface->UpdateProfileImage($id, $request);
            activity()->log(
                sprintf(
                    'Member updated successfully : %s by user: %s',
                    getNameByIdOfTable('members', $id)->first_name,
                    authGuardData('member')->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update Member of id : %s by user : %s', $id, authGuardData('member')->id));

            return null;
        }
    }


    public function updateMember($id, $request)
    {
        try {
            $this->memberInterface->updateMember($id, $request);
            activity()->log(
                sprintf(
                    'Member updated successfully : %s by user: %s',
                    getNameByIdOfTable('members', $id)->first_name,
                    authGuardData('member')->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update Member of id : %s by user : %s', $id, authGuardData('member')->id));

            return null;
        }
    }
}
