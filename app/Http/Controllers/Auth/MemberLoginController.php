<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\VerifyEmail;
use App\Models\VerifyPhone;
use App\Models\Member;
use Auth;
use Mail;
use App\Mail\ResendVerificationLink;
use App\Mail\ResendVerificationCode;
use Carbon\Carbon;
use Twilio\Rest\Client;

class MemberLoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | AdminLogin Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */
  use AuthenticatesUsers;

  public function __construct()
  {
    $this->middleware('guest:member')->except('logout');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function login()
  {
    return view('frontend.auth.login');
  }


  public function loginMember(Request $request)
  {
    $this->validate($request, [
      'email'   => 'required|email',
      'password' => 'required|min:6'
    ]);
  
    // Attempt to log the member in
    if (Auth::guard('member')->attempt(['email' => $request->email, 'password' => $request->password])) {
      if(Auth::guard('member')->user()->isPhoneVerified  == 1){
        if(Auth::guard('member')->user()->status == 0){
          return redirect()->route('frontend.cart'); 
        }
        return redirect()->intended(route('home'));
      }
      else{
        Auth::guard('member')->logout();
        $verifyRoute = route('frontend.member.reverify.phone');
        return redirect()->route('music.login')->withErrors('Please verify your phone first and click <a href="'.$verifyRoute.'" style="font-size:15px;color:blue;"> here </a> to send verification code on sms and email.');     
      }
    }
    return redirect()->back()->withErrors('Crendentials not match');
  }

  public function logout()
  {
      Auth::guard('member')->logout();
      return redirect()->route('music.login');
  }

  public function sendEmailVerifyView(){
    return view('frontend.auth.send-email-verify-link');
  }

  public function sendMemberEmailVerifyLink(Request $request){
    $member = Member::where('email',$request['email'])->first();
    if(isset($member)){
      if($member->email_verified == 1){
        return redirect()->route('music.login')->withMessage('Your Email Address is already verified');
      }  
      else{

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

        return redirect()->route('music.login')->withMessage('Verification Link Has been sent successfully in your email address.');
       
      }
    }
    else{
      return redirect()->route('music.login')->withErrors('Your Email Address is not exists.');
    }
  }

  public function updateMemeberVerify($email){
    $emailDecrpt = decrypt($email);
    $member      = Member::where('email',$emailDecrpt)->first();
    $checkExpiryDate = VerifyEmail::where('email',$member->email)->where('expired_at','>=',Carbon::now()->toDateTimeString())->first();

    if(isset($checkExpiryDate)){

      $member->email_verified = 1;

      if($member->save()){

        return redirect()->route('music.login')->withMessage('Your Email Address is successfully verified!');

      }

    }
    else{
      return redirect()->route('music.login')->withMessage('Your Link is expired!'); 
    }
  }

  public function phoneVerification($phone,Request $request){
    
    $phoneDecrpt     = decrypt($phone);
    $member          = Member::where('phone',$phoneDecrpt)->first();
    $checkExpiryDate = VerifyPhone::where('phone',$member->phone)->where('expired_at','>=',Carbon::now()->toDateTimeString())->first();

    if(isset($checkExpiryDate)){

      if( $checkExpiryDate->code == $request->verification_code ){
        $member->isPhoneVerified = 1;
        if($member->save()){
          return redirect()->route('music.login')->withMessage('Your phone has been successfully verified!');
        }  
      } else{
          return redirect()->back()->withMessage('Please type correct verification code!');
      }
    }
    else{
      return redirect()->route('music.login')->withMessage('Your code is expired!'); 
    }
    
  }

  public function reVerifyPhone(){
    return view('frontend.auth.reverify-phone-verify');
  }

  public function reSendMemberPhoneVerifyCode(Request $request){
    $phoneNumber = $request->country_code.$request->phone;
    $member = Member::where('phone',$phoneNumber)->first();
    if(isset($member)){
      if($member->isPhoneVerified == 1){
        return redirect()->route('music.login')->withMessage('Your Phone number is already verified');
      }  
      else{
        $member->verification_code = mt_rand(111111,999999);

        if( $member->save() ){
            $sendOTP          = $this->sendVerifcationOTP( $member );
            Mail::to($member->email)->send(new ResendVerificationCode($member));
            $verifyPhoneTable = VerifyPhone::where('phone',$member->phone)->first();
            $currentDateTime  = Carbon::now();
            $newDateTime      = $currentDateTime->addHours(15);
              
            if(isset($verifyPhoneTable)){
             $verifyPhoneTable->phone       = $member->phone;
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

        }

       return redirect()->route('music.otp.verify',['phoneNumber' => encrypt( $member->phone )])->withMessage('Successfully Send OTP On your mobile and email address.');
       
      }
    }
    else{
      return redirect()->route('music.login')->withErrors('Your Email Address is not exists.');
    }
    
  }
  
  // Resend Verification code send from member phone verification
  
public function reSendMemberPhoneVerificationForm($phoneNumber){
    $phoneNumber = decrypt($phoneNumber);
    $member = Member::where('phone',$phoneNumber)->first();
    if(isset($member)){
      if($member->isPhoneVerified == 1){
        return redirect()->route('music.login')->withMessage('Your Phone number is already verified');
      }  
      else{
        $member->verification_code = mt_rand(111111,999999);

        if( $member->save() ){
            $sendOTP          = $this->sendVerifcationOTP( $member );
            Mail::to($member->email)->send(new ResendVerificationCode($member));
            $verifyPhoneTable = VerifyPhone::where('phone',$member->phone)->first();
            $currentDateTime  = Carbon::now();
            $newDateTime      = $currentDateTime->addHours(15);
              
            if(isset($verifyPhoneTable)){
             $verifyPhoneTable->phone       = $member->phone;
              $verifyPhoneTable->count      = $verifyPhoneTable->count + 1;
              $verifyPhoneTable->code       = $member->verification_code;
              $verifyPhoneTable->expired_at = $newDateTime;
              $verifyPhoneTable->save();
            }else{
              $newVerifyPhone             =  new VerifyPhone();
              $newVerifyPhone->phone      = $member->phone;
              $newVerifyPhone->code     = $member->verification_code;
              $newVerifyPhone->count      = 1;
              $newVerifyPhone->expired_at = $newDateTime;
              $newVerifyPhone->save();
            }

        }

       return redirect()->route('music.otp.verify',['phoneNumber' => encrypt( $member->phone )])->withMessage('Successfully Send OTP On your mobile and email address.');
       
      }
    }
    else{
      return redirect()->route('music.login')->withErrors('Your Email Address is not exists.');
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


}
