<?php 
namespace App\Music\Repositories\MusicCategory;

use App\Models\MusicCategory;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class MusicCategoryRepository implements MusicCategoryInterface
{
    protected $musicCategory;

    public function __construct(MusicCategory $musicCategory)
    {
        $this->musicCategory = $musicCategory;
    }

    public function save($id, $request)
    {
        if ($id) {
            $musicCategory         = $this->find($id);
            return $musicCategory->update($request);
        }

        $musicCategory = $this->musicCategory->create($request);

        return $musicCategory;
    }

    public function find($id)
    {
        return $this->musicCategory->findOrFail($id);
    }

    public function getMusicCategoryData()
    {
        $musicCategory = $this->musicCategory->get();
        return $musicCategory;
    }

    public function delete($id)
    {
        $musicCategory = $this->find($id);
        
        return $musicCategory->delete();
    }
}
