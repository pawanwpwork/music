<?php 

namespace App\Music\Services\MusicCategory;

use App\Music\Repositories\MusicCategory\MusicCategoryInterface;
use Auth;

class MusicCategoryService
{
    public function __construct(MusicCategoryInterface $musicCategoryInterface)
    {
        $this->musicCategoryInterface = $musicCategoryInterface;
    }

    public function save($request)
    {
        try {

            $response = $this->musicCategoryInterface->save($id = null, $request);
            
            if(Auth::check()){
                activity()->log(sprintf('Music Category created successfully of id: %s by user : %s', auth()->user()->first_name, getUserNameById(auth()->user()->id)->first_name));
    
            }
            else{
                activity()->log(sprintf('Music Category created successfully'));            
            }

            return $response;
        } catch (\Exception $e) {

            if(Auth::check()){
                  activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create MusicCategory by user : %s', auth()->user()->id));
    
            }
            else{
                  activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create MusicCategory by'));            
            }
          

            return null;
        }
    }

    public function getMusicCategoryData()
    {
        return $this->musicCategoryInterface->getMusicCategoryData();
    }

    public function findAll($filters)
    {
        return $this->musicCategoryInterface->findAll($filters);
    }

    public function update($id, $request)
    {
        try {
            $this->musicCategoryInterface->save($id, $request);
            activity()->log(
                sprintf(
                    'Music Category updated successfully : %s by user: %s',
                    getNameByIdOfTable('music_categories', $id)->name,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update MusicCategory of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function delete($id)
    {
        try {
            $this->musicCategoryInterface->delete($id);
            activity()->log(
                sprintf(
                    'MusicCategory Deleted successfully: %s by user: %s',
                    getNameByIdOfTable('music_categories', $id)->name,
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
        return $this->musicCategoryInterface->find($id);
    }
}
