<?php 
namespace App\Music\Repositories\MusicGenre;

use App\Models\MusicGenre;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class MusicGenreRepository implements MusicGenreInterface
{
    protected $musicGenre;

    public function __construct(MusicGenre $musicGenre)
    {
        $this->musicGenre = $musicGenre;
    }

    public function save($id, $request)
    {
        if ($id) {
            $musicGenre            = $this->find($id);
            $request['alias']      = unique_slug($request['name'],'music_genres',$musicGenre->id);
            return $musicGenre->update($request);
        }
        
        $request['alias'] = unique_slug($request['name'],'music_genres');

        $musicGenre = $this->musicGenre->create($request);

        return $musicGenre;
    }

    public function find($id)
    {
        return $this->musicGenre->findOrFail($id);
    }

    public function getmusicGenreData()
    {
        $musicGenre = $this->musicGenre->get();
        return $musicGenre;
    }

    public function delete($id)
    {
        $musicGenre = $this->find($id);
        
        return $musicGenre->delete();
    }
}
