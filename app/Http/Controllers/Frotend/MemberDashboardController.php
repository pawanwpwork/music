<?php

namespace App\Http\Controllers\Frotend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Music\Services\Member\MemberService;
use App\Models\MemberProfile;
use App\Models\Member;
use App\Models\Order;
use App\Music\Services\MemberSetting\MemberSettingService;
use App\Music\Services\MemberPhoto\MemberPhotoService;
use App\Music\Services\MemberVideo\MemberVideoService;
use App\Music\Services\MemberInstrument\MemberInstrumentService;
use App\Music\Services\MemberSong\MemberSongService;
use App\Http\Requests\MemberPhotoRequest;
use App\Http\Requests\MemberVideoRequest;
use App\Http\Requests\MemberDashboardRequest;
use App\Http\Requests\MemberInstrumentRequest;
use App\Http\Requests\MemberSongRequest;
use App\Models\MemberSong;
use File;
use Response;

class MemberDashboardController extends Controller
{
	  protected $memberService;
    protected $memberProfile;
    protected $memberSettingService;
    protected $memberPhotoService;
    protected $memberVideoService;
    protected $memberInstrumentService;

    public function __construct(MemberService $memberService,MemberProfile $memberProfile, MemberSettingService $memberSettingService,MemberPhotoService $memberPhotoService,MemberVideoService $memberVideoService,MemberInstrumentService $memberInstrumentService,MemberSongService $memberSongService){
        $this->middleware('auth:member',['except' => ['storageLocationFileMemberPhoto','storageLocationFileDisplay','storageLocationFileMemberVideo','storageLocationFileMemberInstrument','storageLocationFileMemberSong','storageLocationFileMemberSongLyric']]);
        $this->memberService        = $memberService;
        $this->memberProfile        = $memberProfile;
        $this->memberSettingService = $memberSettingService;
        $this->memberPhotoService   = $memberPhotoService;
        $this->memberVideoService   = $memberVideoService;
        $this->memberInstrumentService   = $memberInstrumentService;
        $this->memberSongService   = $memberSongService;
    }

    public function index(){

    	$memeberId 	    = authGuardData('member')->id;

    	$member 	      = $this->memberService->find($memeberId);

      $memberSetting  = $this->memberSettingService->getFirst($member->membership_type_id);

    	return view('frontend.dashboard.index',compact('member','memeberId','memberSetting'));
    }

    public function editProfile($alias){
        
      $memeberId  = authGuardData('member')->id;

      $member     = $this->memberService->find($memeberId);

      return view('frontend.dashboard.edit-profile',compact('member','memeberId'));

    }

    public function uploadProfileImage(Request $request){

      $input         = $request->all();

      $profile_image = imageUploadPost( isset($request['image']) ? $request['image'] : null, "profile");

      $input['image']  = $profile_image;

      $input['member_id'] = authGuardData('member')->id;

      $response           = $this->memberProfile->create($input);


      if ($response) {
          
          $updloadImageUrl = route('frontend.member.old.profile.image',$response->id);

          return response()->json(['imageUrl'=>$updloadImageUrl,'fileName'=>$response->image,'error'=>false],200);

        } else {

            return response()->json(['data'=>$response,'error'=>true],400);

        }

    }


    public function UpdateProfileImage(Request $request){
      
      $memeberId  = authGuardData('member')->id;


       try {

            $response = $this->memberService->UpdateProfileImage($memeberId,$request->all());
        
            if ($response) {
                return redirect()->back()->withMessage('Successfully update Profile Image!');
            }

        } catch (UserNotFoundException $e) {

          return redirect()->back()->withErrors('Unable to to update profile image please try again.')->withInput($request->all());

        }  
    
    }


    public function editMemberPhoto(){

      $memeberId      = authGuardData('member')->id;

      $member         = $this->memberService->find($memeberId);

      $memberSetting  = $this->memberSettingService->getFirst($member->membership_type_id);

      return view('frontend.dashboard.edit-photo',compact('member','memeberId','memberSetting'));
    }


    public function updateMemberPhoto(MemberPhotoRequest $request){

      try {
            
             $memeberId      = authGuardData('member')->id;

            $member         = $this->memberService->find($memeberId);

            $memberSetting  = $this->memberSettingService->getFirst($member->membership_type_id);

            if(count($member->photo) > $memberSetting->photo){
              return redirect()->back()->withMessage('You don\'t have upload more than '.$memberSetting->photo.' photo!');
            }

            $response      = $this->memberPhotoService->save($request->all());

           
            if ($response) {
              return redirect()->back()->withMessage('Successfully update Member Photo!');
            }

        } catch (UserNotFoundException $e) {

          return redirect()->back()->withErrors('Unable to to update Member Photo please try again.')->withInput($request->all());

        }

    }

    public function updateMember(MemberDashboardRequest $request){

      $memeberId  = authGuardData('member')->id;

      try {

          $response = $this->memberService->updateMember($memeberId,$request->all());
      
          if ($response) {
              return redirect()->back()->withMessage('Successfully update Profile!');
          }

      } catch (UserNotFoundException $e) {

        return redirect()->back()->withErrors('Unable to to update profile image please try again.')->withInput($request->all());

      }  

    } 
       
    public function storageLocationFileMemberPhoto($id)
    {
      $member  = $this->memberPhotoService->find($id);
      $path    = storage_path('app/' . $member->photo);
      if (!File::exists($path)) {
          abort(404);
      }

      $file = File::get($path);
      $type = File::mimeType($path);

      $response = Response::make($file, 200);
      $response->header("Content-Type", $type);

      return $response;
    }

    /**
     * Fetch image path from storage
     * @param $id
     * @return mixed
    */
    public function storageLocationFileDisplay($id)
    {
      $member  = $this->memberProfile->find($id);
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

    // Video
    public function editMemberVideo(){

      $memeberId      = authGuardData('member')->id;

      $member         = $this->memberService->find($memeberId);

      $memberSetting  = $this->memberSettingService->getFirst($member->membership_type_id);

      return view('frontend.dashboard.edit-video',compact('member','memeberId','memberSetting'));
    }


    public function updateMemberVideo(MemberVideoRequest $request){
      // echo phpinfo();exit;
      try {
          
            $memeberId      = authGuardData('member')->id;

            $member         = $this->memberService->find($memeberId);

            $memberSetting  = $this->memberSettingService->getFirst($member->membership_type_id);

            if(count($member->video) > $memberSetting->video){
              return redirect()->back()->withMessage('You don\'t have upload more than '.$memberSetting->video.' video!');
            }
            
            $response      = $this->memberVideoService->save($request->all());

            if ($response) {
              return redirect()->back()->withMessage('Successfully update Member Video!');
            }

        } catch (UserNotFoundException $e) {

          return redirect()->back()->withErrors('Unable to to update Member Video please try again.')->withInput($request->all());

        }

    }

    public function storageLocationFileMemberVideo($id)
    {
      $member  = $this->memberVideoService->find($id);
      $path    = storage_path('app/' . $member->video);
      if (!File::exists($path)) {
          abort(404);
      }

      $file = File::get($path);
      $type = File::mimeType($path);

      $response = Response::make($file, 200);
      $response->header("Content-Type", $type);

      return $response;
    }

    // Instrument
    public function editMemberInstrument(){

      $memeberId      = authGuardData('member')->id;

      $member         = $this->memberService->find($memeberId);

      $memberSetting  = $this->memberSettingService->getFirst($member->membership_type_id);

      return view('frontend.dashboard.edit-instrument',compact('member','memeberId','memberSetting'));
    }


    public function updateMemberInstrument(MemberInstrumentRequest $request){
      
      try {
            
            $memeberId      = authGuardData('member')->id;

            $member         = $this->memberService->find($memeberId);

            $memberSetting  = $this->memberSettingService->getFirst($member->membership_type_id);

            if(count($member->instrument) > $memberSetting->instrument){
              return redirect()->back()->withMessage('You don\'t have upload more than '.$memberSetting->instrument.' instrument!');
            }

            $response      = $this->memberInstrumentService->save($request->all());

           
            if ($response) {
              return redirect()->back()->withMessage('Successfully update Member Instrument!');
            }

        } catch (UserNotFoundException $e) {

          return redirect()->back()->withErrors('Unable to to update Member Instrument please try again.')->withInput($request->all());

        }

    }

    public function storageLocationFileMemberInstrument($id)
    {
      $member  = $this->memberInstrumentService->find($id);
      $path    = storage_path('app/' . $member->instrument);
      if (!File::exists($path)) {
          abort(404);
      }

      $file = File::get($path);
      $type = File::mimeType($path);

      $response = Response::make($file, 200);
      $response->header("Content-Type", $type);

      return $response;
    }


    // Song
    public function submitSongForm(){
      return view('frontend.song-form');
    }

    public function submitSongFormPost(MemberSongRequest $request){
      
      try {

          $memeberId      = authGuardData('member')->id;

          $member         = $this->memberService->find($memeberId);

          $memberSetting  = $this->memberSettingService->getFirst($member->membership_type_id);

           if(count($member->song) > $memberSetting->song){

            return redirect()->route('frontend.song.form')->withMessage('You don\'t have upload more than '.$memberSetting->song.' song!');

          }

          // dump($request->all());exit;

          $songFileName            = imageUploadPublic( isset($request->song) ? $request->song : null, "song");

          $lyricFileName          = imageUploadPublic( isset($request->lyrics) ? $request->lyrics : null, "lyrics");

          $song            = new MemberSong();

          $song->member_id =  $memeberId;

          $song->alias     = unique_slug($request->title,'member_songs');

          $song->title     = $request->title;

          $song->label     = $request->label;

          $song->artist    = $request->artist;

          $song->duration  = $request->duration;

          $song->song      = $songFileName;

          $song->lyrics    = $lyricFileName;


          if($song->save())
          {
            return redirect()->route('frontend.song.form')->withMessage('Successfully Post Song and wait for approving!');
          }

          // $response        = $this->memberSongService->save($request->all());
          // dump($response);
          // exit;
          // if ($response) {
          //   return redirect()->route('frontend.song.form')->withMessage('Successfully Post Song and wait for approving!');
          // }
      } catch (UserNotFoundException $e) {
        return redirect()->back()->withErrors('Unable to to update Member Song please try again.')->withInput($request->all());
      }

    } 

    public function storageLocationFileMemberSong($id)
    {
      $member  = $this->memberSongService->find($id);
      $path    = storage_path('app/' . $member->song);
      if (!File::exists($path)) {
          abort(404);
      }

      $file = File::get($path);
      $type = File::mimeType($path);

      $response = Response::make($file, 200);
      $response->header("Content-Type", $type);

      return $response;
    }


    public function storageLocationFileMemberSongLyric($id)
    {
      $member  = $this->memberSongService->find($id);
      $path    = storage_path('app/' . $member->lyrics);
      if (!File::exists($path)) {
          abort(404);
      }

      $file = File::get($path);
      $type = File::mimeType($path);

      $response = Response::make($file, 200);
      $response->header("Content-Type", $type);

      return $response;
    }


    public function  memeberProfileDetail($alias){

      $memeberId    = Member::where('alias',$alias)->first()->id;

      $member       = $this->memberService->find($memeberId);
      // dd($member);
      return view('frontend.dashboard.profile',compact('member'));
    }


    public function  memberOrderList(){

      $memeberId    = authGuardData('member')->id;

      $orders       = Order::where('member_id',$memeberId)->paginate(10);
      
      return view('frontend.dashboard.order.orders',compact('orders'));

    }


    public function memberOrderDetails($orderId){
      
      $order = Order::with('product','country')->where('order_id',$orderId)->first();
      
      return view('frontend.dashboard.order.order-details',compact('order'));

    }


    public function removeProfileImage(Request $request){

    $input         = $request->all();

     $member       = $this->memberProfile->find( $input['id'] );
     if(isset($member) && $member->delete()){
        return response()->json(['response'=> $input['id'],'error' => false],200);
     }
     else{
        return response()->json(['response'=> $input['id'],'error' => true],200);
     }
    }

}
