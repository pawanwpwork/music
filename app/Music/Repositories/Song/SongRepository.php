<?php 
namespace App\Music\Repositories\Song;

use App\Models\MemberSong;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class SongRepository implements SongInterface
{
    protected $song;

    public function __construct(MemberSong $song)
    {
        $this->song = $song;
    }

    public function save($id, $request)
    {
        if ($id) {
            $song                  = $this->find($id);
            $request["updated_by"] = auth()->user()->id;
            $request['alias']      = unique_slug($request['title'],'member_songs',$song->id);
            return $song->update($request);
        }
        $request["created_by"] = auth()->user()->id;
        $request['alias'] = unique_slug($request['title'],'member_songs');
        $song = $this->song->create($request);

        return $song;
    }

    public function find($id)
    {
        return $this->song->findOrFail($id);
    }

    public function getsongData()
    {
        $song = $this->song->get();
        return $song;
    }

    public function delete($id)
    {
        $song = $this->find($id);

        return $song->delete();
    }
}
