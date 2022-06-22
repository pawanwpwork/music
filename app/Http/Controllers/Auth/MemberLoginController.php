<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\VerifyEmail;
use App\Models\Member;
use Auth;
use Mail;
use App\Mail\ResendVerificationLink;
use Carbon\Carbon;

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
      if(Auth::guard('member')->user()->email_verified == 1){
        // if successful, then redirect to their intended location

        if(Auth::guard('member')->user()->status == 0){
          return redirect()->route('frontend.cart'); 
        }

        return redirect()->intended(route('home'));
      }
      else{
        
        Auth::guard('member')->logout();
        
        $verifyRoute = route('frontend.member.email.verify.view');

        return redirect()->route('music.login')->withErrors('Please verify your email first and click <a href="'.$verifyRoute.'" style="font-size:15px;color:blue;"> here </a> to send link.');     
      }
      
    }
    // if unsuccessful, then redirect back to the login with the form data
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

//     $mytime = Carbon::now();
// echo $mytime->toDateTimeString();
// exit;
    $checkExpiryDate = VerifyEmail::where('email',$member->email)->where('expired_at','>=',Carbon::now()->toDateTimeString())->first();
    // dd(isset($checkExpiryDate));
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

}
