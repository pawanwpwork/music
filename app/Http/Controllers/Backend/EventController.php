<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Music\Services\Event\EventService;
use App\Http\Requests\EventRequest;
use File;
use Response;

class EventController extends Controller
{
    protected $eventService;
    protected $categoryService;

    public function __construct(
        EventService $eventService
    ) {
        $this->middleware('auth',['except' => ['storageLocationFileDisplay']]);
        $this->eventService           = $eventService;
    }

    public function index(Request $request)
    {
        $filters['name']        =  $request->name ?? '';
        
        $filters['model']       =  $request->model ?? '';

        $filters['quantity']    =  $request->quantity ?? '';

        $filters['sku']         =  $request->sku ?? '';
        
        $filters['price']       =  $request->price ?? '';
        
        $filters['status']      =  $request->status ?? '';
        
    	$events = $this->eventService->findAll($filters);
        
        return view('backend.components.event.list',compact('events'));
    }

    public function create(){
    	$events = $this->eventService->geteventData();
        return view('backend.components.event.create',compact('events'));
    }

    public function store(EventRequest $request)
    {
        $response = $this->eventService->save($request->all());
        
        if ($response) {
            return redirect()->route('admin.event.edit',$response->id)->withMessage('Successfully created Event.');
        } else {
            return redirect()->back()->withErrors('Unable to save event. Please try again')->withInput($request->all());
        }
    }

    public function edit($id){
       $event = $this->eventService->find($id);
       $events = $this->eventService->getEventData();
       return view('backend.components.event.edit',compact('event','events'));
    }

    public function update(EventRequest $request, $id)
    {
        if ($this->eventService->update($id, $request->all())) {
            return redirect()->back()->withMessage('Successfully updated Event.');
        } else {
            return redirect()->back()->withErrors('Unable to update event. Please try again')->withInput($request->all());
        }
    }
 

    public function getModalDelete($id = null)
    {
        $model         = 'event';
        $confirm_route = $error = null;
        try {
            $event       = $this->eventService->find($id);
            $confirm_route = route('admin.event.delete', $event->id);
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
            response()->json(['view' => $view]);
        } catch (UserNotFoundException $e) {
            dd($e->getMessage());
        }  
    }

    public function destroy($id = null)
    {
        if ($this->eventService->delete($id)) {
            return redirect()->route('admin.event.list')->withMessage('Successfully deleted event!');
        } else {
            return redirect()->back()->withErrors('Unable to delete event. Please try again');
        }
    }

    public function storageLocationFileDisplay($id)
    {
        $event = $this->eventService->find($id);
        $path    = storage_path('app/' . $event->image);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    // change Status
    public function statusChange($id)
    {
        try {
            $event = $this->eventService->find($id);
            if ($event->status == 1) {
                $event->status = 0;
                $message           = trans_choice('event.success.status_unpublish', 1, ['count' => 1]);
            } else {
                $event->status = 1;
                $message           = trans_choice('event.success.status_publish', 1, ['count' => 1]);
            }

            if ($event->save()) {
                return redirect()->route('admin.event.list')->withMessage($message);
            }
        } catch (Exception $e) {
            return redirect()->route('admin.event.list')->withMessage($e->getMessge());
        }
         
    }
}
