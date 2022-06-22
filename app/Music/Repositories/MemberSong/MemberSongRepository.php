<?php 
namespace App\Music\Repositories\MemberSong;

use App\Models\MemberSong;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class MemberSongRepository implements MemberSongInterface
{
    protected $memberSong;

    public function __construct(MemberSong $memberSong)
    {
        $this->memberSong = $memberSong;
    }

    public function save($id, $request)
    {
        if ($id) {

            $song                = imageUploadPost( isset($request['song']) ? $request['song'] : null, "song");

            $lyrics                = imageUploadPost( isset($request['lyrics']) ? $request['lyrics'] : null, "lyrics");

            $request['member_id'] = authGuardData('member')->id;

            $request['song']     = $song;

            $request['lyrics']     = $lyrics;

            return $memberSong->update($request);
        }

        $song                  = imageUploadPost( isset($request['song']) ? $request['song'] : null, "song");

        $lyrics                = imageUploadPost( isset($request['lyrics']) ? $request['lyrics'] : null, "lyrics");

        $request['song']       = $song;

        $request['lyrics']       = $lyrics;

        $request['member_id']   =  authGuardData('member')->id;
        
        $memberSong            = $this->memberSong->create($request);

        return $memberSong;
    }


    public function find($id){
        $song = $this->memberSong->find($id);
        return $song;
    }
}
