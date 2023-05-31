<?php 
namespace App\Music\Repositories\BandDjBook;

use App\Models\BookBandDj;
use Illuminate\Support\Facades\Auth;


class BandDjBookRepository implements BandDjBookInterface
{
    protected $bandDjBook;

    public function __construct(BookBandDj $bandDjBook)
    {
        $this->bandDjBook      = $bandDjBook;
    }

    public function save($id, $request)
    {
        if ($id) {
            
            $bandDjBook               = $this->find($id);

            $request["updated_by"]    = auth()->user()->id;
            
            $request['event_date']    = databaseDateFormat($request['event_date']);

            $bandDjBook->update($request);

            $bandDjBook->event_type()->detach();

            $bandDjBook->age()->detach();

            if(isset($request['event_type_id'])){    
                $bandDjBook->event_type()->attach($request['event_type_id']);
            }

            if( isset($request['age_group_id']) ){
                $bandDjBook->age()->attach($request['age_group_id']);
            }

             return $bandDjBook;
        }
        
        $request['event_date']    = databaseDateFormat($request['event_date']);

        if(auth()->user()){
            $request["created_by"] = auth()->user()->id;
            $request["booked_by"] = auth()->user()->id;
            $request["add_user_type"] = 'admin';
        }
        
        // $request["event_type_id"] = array_values($request["event_type_id"]);

        // $request["age_group_id"] = array_values($request["age_group_id"]);

        $bandDjBook = $this->bandDjBook->create($request);

        if(isset($request['event_type_id'])){    
            $bandDjBook->event_type()->attach($request['event_type_id']);
        }

        if( isset($request['age_group_id']) ){
            $bandDjBook->age()->attach($request['age_group_id']);
        }

        return $bandDjBook;
    }

    public function find($id)
    {
        return $this->bandDjBook->with('event_type','age')->findOrFail($id);
    }

 
    public function getBandDjBookData()
    {
       // $bandDjBook = $this->bandDjBook->with('event_type','age')->where('order_status',1)->latest()->get();
        $bandDjBook = $this->bandDjBook->with('event_type','age')->latest()->paginate(10);
        return $bandDjBook;
    }

    public function delete($id)
    {
        $bandDjBook = $this->find($id);

        return $bandDjBook->delete();
    }

    public function bankBandDjPostsave($request)
    {
      
        $request['event_date']    = databaseDateFormat($request['event_date']);

        if(authGuardData('member')){
            $request["add_user_type"] = 'member';
            $request["booked_by"] = authGuardData('member')->id;
        }
        
        // $request["event_type_id"] = array_values($request["event_type_id"]);

        // $request["age_group_id"] = array_values($request["age_group_id"]);

        $bandDjBook = $this->bandDjBook->create($request);

        if(isset($request['event_type_id'])){    
            $bandDjBook->event_type()->attach($request['event_type_id']);
        }

        if( isset($request['age_group_id']) ){
            $bandDjBook->age()->attach($request['age_group_id']);
        }

        return $bandDjBook;
    }


    public function cancelBooking($id)
    {
        $bandDjBook         = $this->find($id);

        $bandDjBook->order_status = 2;

        return $bandDjBook->save();
    }
}
