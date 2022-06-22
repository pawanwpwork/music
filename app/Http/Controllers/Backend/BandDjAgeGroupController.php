<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BandDjAgeGroupRequest;
use App\Music\Services\BandDjAgeGroup\BandDjAgeGroupService;

class BandDjAgeGroupController extends Controller
{
	protected $bandDjAgeGroupService;


    /**
     * BandDjAgeGroupController constructor.
     * @param BandDjAgeGroupService $bandDjAgeGroupService
     */
    public function __construct(BandDjAgeGroupService $bandDjAgeGroupService) {

        $this->middleware('auth');

        $this->bandDjAgeGroupService           = $bandDjAgeGroupService;

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$ages = $this->bandDjAgeGroupService->getBandDjAgeGroupData();

        return view('backend.components.band-dj.age-group.list',compact('ages'));
    }

    public function create(){
        return view('backend.components.band-dj.age-group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BandDjAgeGroupRequest $request)
    {
      
        $response = $this->bandDjAgeGroupService->save($request->all());
        
        if ($response) {
            return redirect()->route('admin.banddjagegroup.edit',$response->id)->withMessage('Successfully created Bank/Dj Age Group');
        } else {
            return redirect()->back()->withErrors('Unable to save Bank/Dj Age Group. Please try again')->withInput($request->all());
        }
    }

    public function edit($id){
       $type = $this->bandDjAgeGroupService->find($id);
       return view('backend.components.band-dj.age-group.edit',compact('type'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param BandDjAgeGroupRequest|Request $request
     * @param                         $projectId
     * @param  int                    $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BandDjAgeGroupRequest $request, $id)
    {
        if ($this->bandDjAgeGroupService->update($id, $request->all())) {
            return redirect()->back()->withMessage('Successfully updated Bank/Dj Age Group');
        } else {
            return redirect()->back()->withErrors('Unable to update Bank/Dj Age Group. Please try again')->withInput($request->all());
        }
    }
 

    public function getModalDelete($id = null)
    {
        $model         = 'banddjagegroup';
        $confirm_route = $error = null;
        try {
            $bandDjAgeGroup       	= $this->bandDjAgeGroupService->find($id);
            $confirm_route 			= route('admin.banddjagegroup.delete', $bandDjAgeGroup->id);
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
            response()->json(['view' => $view]);
        } catch (UserNotFoundException $e) {
            dd($e->getMessage());
        }  
    }

    public function destroy($id = null)
    {
       
        if ($this->bandDjAgeGroupService->delete($id)) {
            return redirect()->route('admin.banddjagegroup.list')->withMessage('Successfully deleted Bank/Dj Age Group');
        } else {
            return redirect()->back()->withErrors('Unable to delete Bank Dj Age Group. Please try again');
        }
    }
}
