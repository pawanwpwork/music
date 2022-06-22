<?php 

namespace App\Music\Services\MemberSong;

use App\Music\Repositories\MemberSong\MemberSongInterface;

class MemberSongService
{
    public function __construct(MemberSongInterface $nemberSong)
    {
        $this->nemberSong = $nemberSong;
    }

    public function save($request)
    {
        try {
            $response = $this->nemberSong->save($id = null, $request);
            activity()->log(sprintf('Member Song Post successfully of id: %s by user : %s', authGuardData('member')->first_name, authGuardData('member')->first_name));

            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Member Song by user : %s', authGuardData('member')->id));

            return null;
        }
    }

    public function update($id, $request)
    {
        try {
            $this->nemberSong->save($id, $request);
            activity()->log(
                sprintf(
                    'Membership Song updated successfully :by user: %s',
                    '',
                    authGuardData('member')->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update Member Song of id : %s by user : %s', $id, authGuardData('member')->id));

            return null;
        }
    }

    public function find($id){
        $video = $this->nemberSong->find($id);
        return $video;
    }
}
