<?php 

namespace App\Music\Services\Song;

use App\Music\Repositories\Song\SongInterface;

class SongService
{
    public function __construct(SongInterface $songInterface)
    {
        $this->songInterface = $songInterface;
    }

    public function save($request)
    {
        try {
            $response = $this->songInterface->save($id = null, $request);
            activity()->log(sprintf('Song created successfully of id: %s by user : %s', $request['name'], getUserNameById(auth()->user()->id)->first_name));

            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create song by user : %s', auth()->user()->id));

            return null;
        }
    }

    public function getSongData()
    {
        return $this->songInterface->getSongData();
    }

    public function update($id, $request)
    {
        try {
            $this->songInterface->save($id, $request);
            activity()->log(
                sprintf(
                    'Song updated successfully : %s by user: %s',
                    getNameByIdOfTable('songs', $id)->title,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update product of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function delete($id)
    {
        try {
            $this->songInterface->delete($id);
            activity()->log(
                sprintf(
                    'Song Deleted successfully : %s by user: %s',
                    getNameByIdOfTable('songs', $id)->title,
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
        return $this->songInterface->find($id);
    }
}
