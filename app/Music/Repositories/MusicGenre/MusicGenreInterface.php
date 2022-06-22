<?php 

namespace App\Music\Repositories\MusicGenre;

interface MusicGenreInterface
{
    public function save($id, $request);

    public function getMusicGenreData();

    public function find($id);

    public function delete($id);
}

