<?php 
namespace App\Music\Repositories\BandDjEventType;

use App\Models\BandDJEventType;
use Illuminate\Support\Facades\Auth;


class BandDjEventTypeRepository implements BandDjEventTypeInterface
{
    protected $bandDjEventType;

    public function __construct(BandDJEventType $bandDjEventType)
    {
        $this->bandDjEventType      = $bandDjEventType;
    }

    public function save($id, $request)
    {
        if ($id) {
            
            $bandDjEventType               = $this->find($id);

            $request["updated_by"] = auth()->user()->id;
          
            $request['alias'] = unique_slug($request['name'],'band_dj_event_types',$bandDjEventType->id);
          
            return $bandDjEventType->update($request);
        }
       
        $request["created_by"] = auth()->user()->id;
       
        $request['alias'] = unique_slug($request['name'],'band_dj_event_types');
    
        $bandDjEventType = $this->bandDjEventType->create($request);

        return $bandDjEventType;
    }

    public function find($id)
    {
        return $this->bandDjEventType->findOrFail($id);
    }

 
    public function getBandDjEventTypeData()
    {
       $bandDjEventType = $this->bandDjEventType->latest()->get();
        return $bandDjEventType;
    }

    public function delete($id)
    {
        $bandDjEventType = $this->find($id);

        return $bandDjEventType->delete();
    }
}
