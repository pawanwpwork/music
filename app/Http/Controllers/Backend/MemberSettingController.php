<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Music\Services\MemberSetting\MemberSettingService;
use App\Music\Services\Member\MemberService;
use App\Http\Requests\MemberSettingRequest;

class MemberSettingController extends Controller
{
    protected $memberSettingService, $memberService;

    public function __construct(
        MemberSettingService $memberSettingService, MemberService $memberService
    ) {
        $this->middleware('auth',['except' => ['storageLocationFileDisplay']]);
        $this->memberSettingService               = $memberSettingService;
        $this->memberService               = $memberService;
    }

    public function list(){
        
    	$memberSettings = $this->memberSettingService->getMemberSettingData();
        
        return view('backend.components.member-setting.list',compact('memberSettings'));
    }

    public function edit($id){
        $memberSetting = $this->memberSettingService->find($id);
        $memberships = $this->memberService->getMembershipTypeData();
        return view('backend.components.member-setting.edit',compact('memberSetting', 'memberships'));
    
    }

    public function update(MemberSettingRequest $request, $id)
    {
        if ($this->memberSettingService->update($id, $request->all())) {
            return redirect()->back()->withMessage('Successfully updated member setting!');
        } else {
            return redirect()->back()->withErrors('Unable to update member. Please try again')->withInput($request->all());
        }
    }
 
}
