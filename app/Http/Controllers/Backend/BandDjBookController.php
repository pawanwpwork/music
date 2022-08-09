<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BandDjBookRequest;
use App\Music\Services\BandDjBook\BandDjBookService;
use App\Music\Services\BandDjEventType\BandDjEventTypeService;
use App\Music\Services\BandDjAgeGroup\BandDjAgeGroupService;
use Mail;
use App\Mail\BandDjBookCancel;
use App\Models\Member;

class BandDjBookController extends Controller
{
    protected $bandDjBookService;

    protected $bandDjEventTypeService;

    protected $bandDjAgeGroupService;

    /**
     * BandDjBookController constructor.
     * @param BandDjBookService $bandDjBookService
     */
    public function __construct(BandDjBookService $bandDjBookService,BandDjEventTypeService $bandDjEventTypeService, BandDjAgeGroupService $bandDjAgeGroupService) {

        $this->middleware('auth');

        $this->bandDjBookService           = $bandDjBookService;

        $this->bandDjAgeGroupService       = $bandDjAgeGroupService;

        $this->bandDjEventTypeService      = $bandDjEventTypeService;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$books = $this->bandDjBookService->getBandDjBookData();

        return view('backend.components.band-dj.list',compact('books'));
    }


    public function create(){
        
        $ages = $this->bandDjAgeGroupService->getBandDjAgeGroupData();

        $types = $this->bandDjEventTypeService->getBandDjEventTypeData();

        return view('backend.components.band-dj.create',compact('types','ages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BandDjBookRequest $request)
    {
      
        $response = $this->bandDjBookService->save($request->all());
        
        if ($response) {
            return redirect()->route('admin.banddjbook.edit',$response->id)->withMessage('Successfully created Bank/Dj Book');
        } else {
            return redirect()->back()->withErrors('Unable to save Bank/Dj Book. Please try again')->withInput($request->all());
        }
    }

    public function edit($id){

        $book = $this->bandDjBookService->find($id);

        // dd($book);
        
        $ages = $this->bandDjAgeGroupService->getBandDjAgeGroupData();

        $types = $this->bandDjEventTypeService->getBandDjEventTypeData();

        return view('backend.components.band-dj.edit',compact('book','ages','types'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param BandDjBookRequest|Request $request
     * @param                         $projectId
     * @param  int                    $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BandDjBookRequest $request, $id)
    {
        if ($this->bandDjBookService->update($id, $request->all())) {
            return redirect()->back()->withMessage('Successfully updated Bank/Dj Book');
        } else {
            return redirect()->back()->withErrors('Unable to update Bank/Dj Book. Please try again')->withInput($request->all());
        }
    }
 

    public function getModalDelete($id = null)
    {
        $model         = 'banddjbook';
        $confirm_route = $error = null;
        try {
            $bandDjBook       = $this->bandDjBookService->find($id);
            $confirm_route = route('admin.banddjbook.delete', $bandDjBook->id);
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
            response()->json(['view' => $view]);
        } catch (UserNotFoundException $e) {
            dd($e->getMessage());
        }  
    }

    public function destroy($id = null)
    {
       
        if ($this->bandDjBookService->delete($id)) {
            return redirect()->route('admin.banddjbook.list')->withMessage('Successfully deleted Bank/Dj Book.');
        } else {
            return redirect()->back()->withErrors('Unable to delete Bank Dj Book. Please try again');
        }
    }


    public function cancelBookingModal($id = null)
    {
        $model         = 'banddjbookcancel';
        $confirm_route = $error = null;
        try {
            $bandDjBook       = $this->bandDjBookService->find($id);
            $confirm_route = route('admin.banddjbook.cancel', $bandDjBook->id);
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
            response()->json(['view' => $view]);
        } catch (UserNotFoundException $e) {
            dd($e->getMessage());
        }  
    }

    public function cancelBooking($id = null)
    {
       
        if ($this->bandDjBookService->cancelBooking($id)) {
            
            $bandDjBook   = $this->bandDjBookService->find($id);

            if( $bandDjBook->add_user_type == 'member' )
            {
                $member = Member::find($bandDjBook->booked_by);
                if( isset( $member ) )
                {
                    Mail::to($member->email)->send(new BandDjBookCancel($bandDjBook));
                }
            }
            
            return redirect()->route('admin.banddjbook.list')->withMessage('Successfully cancel Bank/Dj Book.');
        } else {
            return redirect()->back()->withErrors('Unable to cancel Band/Dj Book. Please try again');
        }
    }

}
