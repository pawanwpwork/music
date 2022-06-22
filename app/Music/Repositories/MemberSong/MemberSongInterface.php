<?php 

namespace App\Music\Repositories\MemberSong;

interface MemberSongInterface
{
    public function save($id, $request);

    public function find($id);
}

