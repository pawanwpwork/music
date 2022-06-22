<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ResetMemberPassword;
use Mail;
use App\Models\Member;
use Validator;

class MemberForgotPasswordController extends Controller
{
 

  public function __construct()
  {
    $this->middleware('guest:member');
  }

  public function memberForgotPassword(){
    return view('frontend.auth.member-forget-password');
  }

  public function sendMemberResetPasswordLink(Request $request){

    $member = Member::where('email',$request['email'])->first();

    if(isset($member)){
 
       $sendVerifyLink = Mail::to($member->email)->send(new ResetMemberPassword($member)); 
      
        return redirect()->route('music.login')->withMessage('Password Reset Link Has been sent successfully in your email address.');
       
    }
    else{
      return redirect()->route('music.login')->withErrors('Member is not exists.');
    }
    
  }


  public function memberResetPasswordForm($email){
  	$decryptEmail = decrypt($email);
    return view('frontend.auth.member-rest-password',compact('decryptEmail','email'));
  }


  public function memberResetPasswordPost(Request $request, $email){

  	 $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
        ]);

    if ($validator->fails()) {
        return redirect()->route('frontend.member.reset.password.form',$email)
                    ->withErrors($validator)
                    ->withInput();
    }
        

    $emailDecrpt = decrypt($email);

    $member      = Member::where('email',$emailDecrpt)->first();

    $member->password = bcrypt($request->password);

    if($member->save()){
    	return redirect()->route('music.login')->withMessage('Your Password has been reset successfully.');
    }
    else{
    	return redirect()->route('music.login')->withErrors('Something went wrong!');
    }


  }

}
