<?php 
namespace App\Music\Repositories\Member;

use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;
use App\Models\MusicGenre;
use App\Models\MembershipType;
use App\Models\MusicCategory;

class MemberRepository implements MemberInterface
{
    protected $member;

    public function __construct(Member $member, MusicGenre $musicGenre, MusicCategory $musicCategory, MembershipType $membershipType)
    {
        $this->member = $member;
        $this->musicGenre = $musicGenre;
        $this->musicCategory = $musicCategory;
        $this->membershipType = $membershipType;
    }

    public function save($id, $request)
    {
        if ($id) {
            $member                = $this->find($id);
            $request["updated_by"] = auth()->user()->id;
            $request['password']   = bcrypt($request['password']);
            return $member->update($request);
        }
        $request["created_by"] = auth()->user()->id;
        $request['password']   = bcrypt($request['password']);
   
        
        $member = $this->member->create($request);

        return $member;
    }

    public function find($id)
    {
        return $this->member->with('image','photo','song','video','instrument')->findOrFail($id);
    }

    public function findAll($filters = [], $status = 1){

        $results = $this->member->when(array_filter($filters), function($query) use ($filters){
            if( isset( $filters['first_name'] ) && array_key_exists('first_name', $filters) ){
                $query->where('first_name', 'like','%' . $filters['first_name'] . '%');
            }
            if(isset( $filters['last_name'] ) && array_key_exists('last_name', $filters)){
                $query->where('last_name', 'like','%' . $filters['last_name'] . '%');
            }
            if(isset( $filters['email'] ) && array_key_exists('email', $filters)){
                $query->where('email', 'like','%' . $filters['email'] . '%');
            }
            if(isset( $filters['ip'] ) && array_key_exists('ip', $filters)){
                $query->where('ip', 'like','%' . $filters['ip'] . '%');
            }
            if(isset( $filters['date'] ) && array_key_exists('date', $filters)){
                $query->where('date_added',  $filters['date'] );
            }
            if(isset( $filters['status'] ) && array_key_exists('status', $filters)){
                $query->where('status', $filters['status']);
            }
            return $query;
        })->orderBy('id','desc')->get();


        return $results;
    }

    public function getMemberData()
    {
        $member = $this->member->get();
        return $member;
    }

    public function getMusicCategoryData()
    {
        $categories = $this->musicCategory->pluck('name', 'id')->toArray();
        return $categories;
    }

    public function getGenreData()
    {
        $genres = $this->musicGenre->pluck('name', 'id')->toArray();
        return $genres;
    }

    public function getMembershipTypeData()
    {
        $membershipTypes = $this->membershipType->pluck('name', 'id')->toArray();
        return $membershipTypes;
    }

    public function delete($id)
    {
        $member = $this->find($id);
        return $member->delete();
    }

    public function signup($request)
    {
        $request['password']        = bcrypt($request['password']);
        $profile_image              = imageUploadPost( isset($request['profile_image']) ? $request['profile_image'] : null, "profile");
        $request['profile_image']  = $profile_image;
        $slugText                  = $request['first_name'].' '.$request['last_name'];
        $request['alias']          = unique_slug($slugText,'members');
        $request['dob']            = databaseDateFormat($request['dob']);
        $request['status']         = 0;
        
        $member                    = $this->member->create($request);
        // dd($member);
        if($member->membership_type_id == 1){
            $memberUpdate = $this->member->find($member->id);
            $memberUpdate->update(['status'=>1]);
        }
        if(isset($request['music_category_id']) && $member->membership_type_id == 2 ){
            $member->musicCategory()->attach($request['music_category_id']);
        }

        return $member;
    }

    public function UpdateProfileImage($id, $request)
    {
        $member                = $this->find($id);
        $request["updated_by"] = authGuardData('member')->id;
        return $member->update($request);
    }


    public function updateMember($id, $request)
    {
        $member                = $this->find($id);
        $request["updated_by"] = authGuardData('member')->id;
        $request["dob"]        = databaseDateFormat($request["dob"]);
        return $member->update($request);
    }

}
