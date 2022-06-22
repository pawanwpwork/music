<?php 

namespace App\Music\Services\MusicGenre;

use App\Music\Repositories\MusicGenre\MusicGenreInterface;

class MusicGenreService
{
    public function __construct(MusicGenreInterface $musicGenreInterface)
    {
        $this->musicGenreInterface = $musicGenreInterface;
    }

    public function save($request)
    {
        try {
            $response = $this->musicGenreInterface->save($id = null, $request);
            activity()->log(sprintf('MusicGenre created successfully'));

            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create MusicGenre by user : %s', auth()->user()->id));

            return null;
        }
    }

    public function getMusicGenreData()
    {
        return $this->musicGenreInterface->getMusicGenreData();
    }

    public function findAll($filters)
    {
        return $this->musicGenreInterface->findAll($filters);
    }

    public function update($id, $request)
    {
        try {
            $this->musicGenreInterface->save($id, $request);
            activity()->log(
                sprintf(
                    'MusicGenre updated successfully'
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update MusicGenre of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function delete($id)
    {
        try {
            $this->musicGenreInterface->delete($id);
            activity()->log(
                sprintf(
                    'MusicGenre Deleted successfully'
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
        return $this->musicGenreInterface->find($id);
    }
}
