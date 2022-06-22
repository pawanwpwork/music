<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Music\Services\Member\MemberService;
use App\Http\Requests\MemberRequest;
use App\Http\Requests\MemberRequestUpdate;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    protected $memberService;

    public function __construct(
        MemberService $memberService
    ) {
        $this->middleware('auth',['except' => ['storageLocationFileDisplay']]);
        $this->memberService               = $memberService;
    }

    public function index(Request $request)
    {
        $memberships = $this->memberService->getMembershipTypeData();
        
        $filters['first_name']          =  $request->first_name ?? null;

        $filters['last_name']           =  $request->last_name ?? null;
        
        $filters['membership_type_id']  =  $request->membership_type_id ?? null;

        $filters['quantity']            =  $request->quantity ?? null;

        $filters['ip']                  =  $request->ip ?? null;
        
        $filters['date']                =  $request->date ?? null;
        
        $filters['status']              =  $request->status ?? null;
        
    	$members                        = $this->memberService->findAll($filters);
        
        return view('backend.components.member.list',compact('members', 'memberships'));
    }

    public function create(){
    	
        $members     = $this->memberService->getmemberData();
    	
        $categories  = $this->memberService->getMusicCategoryData();
    	
        $genres      = $this->memberService->getGenreData();

    	$memberships = $this->memberService->getMembershipTypeData();

        return view('backend.components.member.create',compact('members', 'genres', 'memberships', 'categories'));

    }

    public function store(MemberRequest $request)
    {
        $response = $this->memberService->signup($request->all());
        
        if ($response) {
            return redirect()->route('admin.member.edit',$response->id)->withMessage('Successfully created member!');
        } else {
            return redirect()->back()->withErrors('Unable to save member. Please try again!')->withInput($request->all());
        }
    }

    public function edit($id){
        
        $member      = $this->memberService->find($id);
        
        $members     = $this->memberService->getmemberData();
        
        $categories  = $this->memberService->getMusicCategoryData();
    	
        $genres      = $this->memberService->getGenreData();

    	$memberships = $this->memberService->getMembershipTypeData();
       
        return view('backend.components.member.edit',compact('member','members', 'genres', 'memberships', 'categories'));
    
    }

    public function update(MemberRequestUpdate $request, $id)
    {
        if ($this->memberService->update($id, $request->all())) {
            return redirect()->back()->withMessage('Successfully updated member');
        } else {
            return redirect()->back()->withErrors('Unable to update member. Please try again')->withInput($request->all());
        }
    }
 

    public function getModalDelete($id = null)
    {
        $model         = 'member';
        $confirm_route = $error = null;
        try {
            $member       = $this->memberService->find($id);
            $confirm_route = route('admin.member.delete', $member->id);
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
            response()->json(['view' => $view]);
        } catch (UserNotFoundException $e) {
            dd($e->getMessage());
        }  
    }

    public function destroy($id = null)
    {
        if ($this->memberService->delete($id)) {
            return redirect()->route('admin.member.list')->withMessage('Successfully deleted member!');
        } else {
            return redirect()->back()->withErrors('Unable to delete member. Please try again');
        }
    }

    public function storageLocationFileDisplay($id)
    {
        $member = $this->memberService->find($id);
        $path    = storage_path('app/' . $member->image);
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
            $member = $this->memberService->find($id);
            if ($member->status == 1) {
                $member->status = 0;
                $message           = trans_choice('member.success.status_unpublish', 1, ['count' => 1]);
            } else {
                $member->status = 1;
                $message           = trans_choice('member.success.status_publish', 1, ['count' => 1]);
            }

            if ($member->save()) {
                return redirect()->route('admin.member.list')->withMessage($message);
            }
        } catch (Exception $e) {
            return redirect()->route('admin.member.list')->withMessage($e->getMessge());
        }
    }

    public function onlyTrashMember( Request $request ){

        DB::enableQueryLog();

        $menberQuery   = new Member();

        $query         = $menberQuery->newQuery();

        if( isset( $request->first_name ) )
        {
            $query->where('first_name', 'LIKE', '%'.$request->first_name.'%');   
        }


        if( isset( $request->last_name ) )
        {
            $query->where('last_name', 'LIKE', '%'.$request->last_name.'%');   
        }


        if( isset( $request->email ) )
        {
            $query->where('email', 'LIKE', '%'.$request->email.'%'); 
        }


        if( isset( $request->membership_type_id ) )
        {
            $query->where('membership_type_id',$request->membership_type_id);   
        }

        if( isset( $request->ip ) )
        {
            $query->where('ip', 'LIKE', '%'.$request->ip.'%');   
        }

        if( isset( $request->date ) )
        {
            $query->whereDate('date_added', $request->date);   
        }

        if( isset( $request->status ) )
        {
            $query->where('status', $request->status);    
        }
        
        $members        = $query->onlyTrashed()->get();

        $memberships = $this->memberService->getMembershipTypeData();
        
        return view('backend.components.member.trash-list',compact('members','memberships'));
    }

    public function restoreTrashMember( $id )
    {
        $resore = Member::withTrashed()->find($id)->restore();
        if( $resore ) {
            return redirect()->route('admin.member.restore.list')->withMessage('Successfully resored member!');
        }
    }

    public function permanentlyRemoveMember( $id )
    {
        $resore = Member::withTrashed()->find($id);
        if( $resore->forceDelete() ) {
            return redirect()->route('admin.member.restore.list')->withMessage('Successfully deleted member!');
        }
    }
}
