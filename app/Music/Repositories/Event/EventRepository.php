<?php 
namespace App\Music\Repositories\Event;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class EventRepository implements EventInterface
{
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function save($id, $request)
    {
        if ($id) {

            $event                 = $this->find($id);
           
            $request["updated_by"] = auth()->user()->id;
            
            $request['alias']      = $event->alias;
          
            if($request['image'] != $event->image){
                $oldPath          = storage_path('app/' . $event->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
                $image_name = imageUploadPost( isset($request['image']) ? $request['image'] : null, "event",1135,643 );
            }
            else{
                $image_name = $request['image'];
            }
            $request['image'] = $image_name;

            $request['date_start']    = databaseDateFormat($request['date_start']);
        
            $request['date_end']      = databaseDateFormat($request['date_end']);

            $request['event_start_date']    = databaseDateFormat($request['event_start_date']);
        
            $request['event_end_date']      = databaseDateFormat($request['event_end_date']);

            return $event->update($request);
        }
        
        $image_name = imageUploadPost( isset($request['image']) ? $request['image'] : null, "event");
        
        if(auth()->user() != null){
            $request["add_user_type"]   = 'admin';
            $request["created_by"]      = auth()->user()->id;
        }
        
        $request['alias']         = unique_slug($request['name'],'events');
        
        $request['image']         = $image_name;

        $request['date_start']    = databaseDateFormat($request['date_start']);
        
        $request['date_end']      = databaseDateFormat($request['date_end']);

        $request['event_start_date']    = databaseDateFormat($request['event_start_date']);
        
        $request['event_end_date']      = databaseDateFormat($request['event_end_date']);
        
        $event = $this->event->create($request);

        return $event;
    }

    public function find($id)
    {
        return $this->event->findOrFail($id);
    }

    public function findFromAlias($alias)
    {
        return $this->event->where('alias', $alias)->where('status','approved')->first();
    }

    public function findAll($filters = [], $status = 1){
        
        if(isset($filters) && count($filters)){

            $results = $this->event->where('order_status',1)->when( array_filter($filters), function($query) use ($filters){
            if(array_key_exists('name', $filters)){

                $query->where('name', 'like','%' . $filters['name'] . '%');
            }
            if(array_key_exists('model', $filters)){
                $query->where('model', 'like','%' . $filters['model'] . '%');
            }
            if(array_key_exists('price', $filters)){
                $query->where('price', 'like','%' . $filters['price'] . '%');
            }
            if(array_key_exists('sku', $filters)){
                $query->where('sku', 'like','%' . $filters['sku'] . '%');
            }
            if(array_key_exists('quantity', $filters)){
                $query->where('quantity', 'like','%' . $filters['quantity'] . '%');
            }
            if(array_key_exists('status', $filters)){
                $query->where('status', $filters['status']);
            }

            if(array_key_exists('from_date', $filters) && array_key_exists('to_date', $filters)){
                $query->whereDate('event_end_date', '>=',date('Y-m-d',strtotime($filters['from_date'])));
                $query->whereDate('event_end_date', '<=',date('Y-m-d',strtotime($filters['to_date'])));
            }

            if( array_key_exists('calender_date', $filters) ){
                $query->whereDate('date_start',$filters['calender_date']);
            }

            if( array_key_exists('current_date', $filters) ){
                $query->whereDate( 'date_end', '>=', date('Y-m-d' ) );
            }

            return $query;

        })->orderBy('event_end_date','ASC')
        ->get();
        }
        else{
            $results = $this->event->whereDate('date_start', '>=',date('Y-m-d'))->orderBy('event_end_date','ASC')->get();
        }
        return $results;
    }

    public function geteventData()
    {
        $event = $this->event->latest()->get();
        return $event;
    }

    public function delete($id)
    {
        $event = $this->find($id);

        return $event->delete();
    }



    public function postEventsave($request)
    {
        $image_name = imageUploadPost( isset($request['image']) ? $request['image'] : null, "event");
     
        if(authGuardData('member') != null){
            $request['add_user_type']   = 'member';
            $request["member_id"]       = authGuardData('member')->id;   
        }

        $request['alias']               = unique_slug($request['name'],'events');
        
        $request['image']               = $image_name;

        $request['date_start']          = databaseDateFormat($request['date_start']);
        
        $request['date_end']            = databaseDateFormat($request['date_end']);
        
        $request['event_start_date']    = databaseDateFormat($request['event_start_date']);
        
        $request['event_end_date']      = databaseDateFormat($request['event_end_date']);

        $event                          = $this->event->create($request);

        return $event;
    }
}
