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
use App\Mail\ResendVerificationLink;
use App\Mail\ResendVerificationCode;
use Carbon\Carbon;
use App\Models\VerifyEmail;
use App\Models\VerifyPhone;
use App\Models\Member;
use App\Models\Cart;
use App\Models\MembershipType;
use App\Models\MembershipSettings;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;
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
                $member             = Member::where('phone',$response->phone)->first();
                $sendOTP            = $this->sendVerifcationOTP( $member );
                Mail::to($member->email)->send(new ResendVerificationCode($member));
                $verifyPhoneTable   = VerifyPhone::where('phone',$member->phone)->first();
                $currentDateTime    = Carbon::now();
                $newDateTime        = $currentDateTime->addMinutes(15);
                if(isset($verifyPhoneTable)){
                  $verifyPhoneTable->phone      = $member->phone;
                  $verifyPhoneTable->count      = $verifyPhoneTable->count + 1;
                  $verifyPhoneTable->code       = $member->verification_code;
                  $verifyPhoneTable->expired_at = $newDateTime;
                  $verifyPhoneTable->save();
                }else{
                  $newVerifyPhone             =  new VerifyPhone();
                  $newVerifyPhone->phone      = $member->phone;
                  $newVerifyPhone->code       = $member->verification_code;
                  $newVerifyPhone->count      = 1;
                  $newVerifyPhone->expired_at = $newDateTime;
                  $newVerifyPhone->save();
                }

                if($member->status == 0){
                    $this->addToCartForMember($member);
                }
                DB::commit();
                return redirect()->route('music.otp.verify',['phoneNumber' => encrypt( $member->phone )])->withMessage('Successfully Send OTP On your mobile and email address.');
            }

        } catch (UserNotFoundException $e) {
             DB::rollback();
            return redirect()->back()->withErrors('Unable to to register please try again.')->withInput($request->all());

        }  

    }

    public function sendVerifcationOTP( $member ){
        $token         = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid    = getenv("TWILIO_SID");
        $twilio_number = '+13016587597';
        $twilio        = new Client($twilio_sid, $token);

        $twilio->messages->create(
            // Where to send a text message (your cell phone?)
            $member->phone,
            // '+9779849224290',
            array(
                'from' => $twilio_number,
                'body' => 'Your verification code is '.$member->verification_code
            )
        );
    }

    public function phoneOTPVerify( $phoneNumber ){
        return view('frontend.auth.member-phone-verification-form',compact('phoneNumber'));
    }

    public function addToCartForMember($data){
        $membershipType     = MembershipType::find($data->membership_type_id);
        $membershipSetting  = MembershipSettings::where('membership_type_id',$data->membership_type_id)->first();
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
