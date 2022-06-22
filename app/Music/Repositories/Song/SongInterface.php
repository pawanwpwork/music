<?php 

namespace App\Music\Repositories\Song;

interface SongInterface
{
    public function save($id, $request);

    public function getSongData();

    public function find($id);

    public function delete($id);
}

