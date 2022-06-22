<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BandDjEventTypeRequest;
use App\Music\Services\BandDjEventType\BandDjEventTypeService;

class BandDjEventTypeController extends Controller
{
	protected $bandDjEventTypeService;


    /**
     * BandDjEventTypeController constructor.
     * @param BandDjEventTypeService $bandDjEventTypeService
     */
    public function __construct(BandDjEventTypeService $bandDjEventTypeService) {

        $this->middleware('auth');

        $this->bandDjEventTypeService           = $bandDjEventTypeService;

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$types = $this->bandDjEventTypeService->getBandDjEventTypeData();

        return view('backend.components.band-dj.event.list',compact('types'));
    }

    public function create(){
        return view('backend.components.band-dj.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BandDjEventTypeRequest $request)
    {
      
        $response = $this->bandDjEventTypeService->save($request->all());
        
        if ($response) {
            return redirect()->route('admin.banddjeventtype.edit',$response->id)->withMessage('Successfully created Bank/Dj Event Type');
        } else {
            return redirect()->back()->withErrors('Unable to save Bank/Dj Event Type. Please try again')->withInput($request->all());
        }
    }

    public function edit($id){
       $type = $this->bandDjEventTypeService->find($id);
       return view('backend.components.band-dj.event.edit',compact('type'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param BandDjEventTypeRequest|Request $request
     * @param                         $projectId
     * @param  int                    $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BandDjEventTypeRequest $request, $id)
    {
        if ($this->bandDjEventTypeService->update($id, $request->all())) {
            return redirect()->back()->withMessage('Successfully updated Bank/Dj Event Type');
        } else {
            return redirect()->back()->withErrors('Unable to update Bank/Dj Event Type. Please try again')->withInput($request->all());
        }
    }
 

    public function getModalDelete($id = null)
    {
        $model         = 'banddjeventtype';
        $confirm_route = $error = null;
        try {
            $bandDjEventType       = $this->bandDjEventTypeService->find($id);
            $confirm_route = route('admin.banddjeventtype.delete', $bandDjEventType->id);
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
            response()->json(['view' => $view]);
        } catch (UserNotFoundException $e) {
            dd($e->getMessage());
        }  
    }

    public function destroy($id = null)
    {
       
        if ($this->bandDjEventTypeService->delete($id)) {
            return redirect()->route('admin.banddjeventtype.list')->withMessage('Successfully deleted Bank/Dj Event Type');
        } else {
            return redirect()->back()->withErrors('Unable to delete Bank Dj Event Type. Please try again');
        }
    }
    
}
