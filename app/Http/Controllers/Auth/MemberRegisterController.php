<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Music\Services\Member\MemberService;
use App\Music\Services\SliderImage\SliderImageService;
use App\Http\Requests\MemberRequest;
use App\Music\Services\MusicCategory\MusicCategoryService;
use App\Music\Services\MemberSetting\MemberSettingService;
use App\Http\Requests\MusicCategoryRequest;
// New code for fast completion
use App\Mail\ResendVerificationLink;
use Carbon\Carbon;
use App\Models\VerifyEmail;
use App\Models\Member;
use App\Models\Cart;
use App\Models\MembershipType;
use App\Models\MembershipSettings;
use Illuminate\Support\Facades\DB;
use File;
use Response;
use Auth;
use Mail;


class MemberRegisterController extends Controller
{
   	protected $memberService;
    protected $musicCategory;
    protected $memberSettingService;

    public function __construct(MemberService $memberService, MusicCategoryService $musicCategory, MemberSettingService $memberSettingService){
        $this->memberService          = $memberService;
        $this->musicCategory          = $musicCategory;
        $this->memberSettingService   = $memberSettingService;
    }


    public function register(){
        
        $fanMember           = $this->memberSettingService->getFirst(1);
        $musicianMember      = $this->memberSettingService->getFirst(2);
        $bandLeaderMember    = $this->memberSettingService->getFirst(3);
        $eventPromoterMember = $this->memberSettingService->getFirst(4);

    	return view('frontend.auth.sign-up',compact('fanMember','musicianMember','bandLeaderMember','eventPromoterMember'));
    }

    public function memberRegisterFormByType($type){

    	$members     = $this->memberService->getmemberData();
    	
        $categories  = $this->memberService->getMusicCategoryData();
    	
        $genres      = $this->memberService->getGenreData();

    	$memberships = $this->memberService->getMembershipTypeData();

    	return view('frontend.auth.member-register-form',compact('type','members', 'genres', 'memberships', 'categories'));
    }

    public function memberPostFormByType(MemberRequest $request){

        try {
            DB::beginTransaction();
            $response = $this->memberService->signup($request->all());

            if($response) {

                $member = Member::where('email',$response->email)->first();

                $sendVerifyLink = Mail::to($member->email)->send(new ResendVerificationLink($member)); 
      
                $verifyEmailTable = VerifyEmail::where('email',$member->email)->first();

                $currentDateTime = Carbon::now();

                $newDateTime = $currentDateTime->addHours(24);
                  

                if(isset($verifyEmailTable)){
                  $verifyEmailTable->email = $member->email;
                  $verifyEmailTable->count = $verifyEmailTable->count + 1;
                  $verifyEmailTable->expired_at = $newDateTime;
                  $verifyEmailTable->save();
                }else{
                  $newVerifyEmail =  new VerifyEmail();
                  $newVerifyEmail->email = $member->email;
                  $newVerifyEmail->count = 1;
                  $newVerifyEmail->expired_at = $newDateTime;
                  $newVerifyEmail->save();
                }

                if($member->status == 0){
                    $this->addToCartForMember($member);
                }
                 DB::commit();
                return redirect()->route('music.login')->withMessage('Successfully Register. Verification Link Has been sent successfully in your email address for email verification');


                return redirect()->route('music.login')->withMessage('Successfully Register');
            }

        } catch (UserNotFoundException $e) {
             DB::rollback();
            return redirect()->back()->withErrors('Unable to to register please try again.')->withInput($request->all());

        }  

    }

    public function addToCartForMember($data){
        
        $membershipType = MembershipType::find($data->membership_type_id);

        $membershipSetting = MembershipSettings::where('membership_type_id',$data->membership_type_id)->first();

        $cart = new Cart();
        $cart->member_id = $data->id;
        $cart->type = 'membership';
        $cart->product_name = $membershipType->name.' signup Fee';
        $cart->price = $membershipSetting->sign_up_fee;
        $cart->quantity = 1;        
        $cart->product_id = $data->id;
        $cart->save();
        
    }

    public function createMusicCategoryFromMemberRegisterForm(MusicCategoryRequest $request){

        $response = $this->musicCategory->save($request->all());
        
        if ($response) {

            return response()->json(['data'=>$response,'error'=>false],200);

        } else {

            return response()->json(['data'=>$response,'error'=>true],400);

        }
        
    }


    /**
     * Fetch image path from storage
     * @param $id
     * @return mixed
     */
    public function storageLocationFileDisplay($id)
    {
        $member  = $this->memberService->find($id);
        $path    = storage_path('app/' . $member->profile_image);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
