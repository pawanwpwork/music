<?php 
namespace App\Music\Repositories\BandDjAgeGroup;

use App\Models\BandDjAgeGroup;
use Illuminate\Support\Facades\Auth;


class BandDjAgeGroupRepository implements BandDjAgeGroupInterface
{
    protected $bandDjAgeGroup;

    public function __construct(BandDjAgeGroup $bandDjAgeGroup)
    {
        $this->bandDjAgeGroup      = $bandDjAgeGroup;
    }

    public function save($id, $request)
    {
        if ($id) {
            
            $bandDjAgeGroup        = $this->find($id);

            $request["updated_by"] = auth()->user()->id;
          
            $request['alias'] = unique_slug($request['name'],'band_dj_age_groups',$bandDjAgeGroup->id);
          
            return $bandDjAgeGroup->update($request);
        }
       
        $request["created_by"] = auth()->user()->id;
       
        $request['alias'] = unique_slug($request['name'],'band_dj_age_groups');
    
        $bandDjAgeGroup = $this->bandDjAgeGroup->create($request);

        return $bandDjAgeGroup;
    }

    public function find($id)
    {
        return $this->bandDjAgeGroup->findOrFail($id);
    }

 
    public function getBandDjAgeGroupData()
    {
       $bandDjAgeGroup = $this->bandDjAgeGroup->latest()->get();
        return $bandDjAgeGroup;
    }

    public function delete($id)
    {
        $bandDjAgeGroup = $this->find($id);

        return $bandDjAgeGroup->delete();
    }
}
