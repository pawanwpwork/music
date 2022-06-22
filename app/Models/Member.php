<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MembershipType;
use App\Models\MusicCategory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MemberInstrument;
use App\Models\MemberPhoto;
use App\Models\MemberSong;
use App\Models\MemberVideo;
use App\Models\MemberProfile;
use App\Models\MusicGenre;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
     use HasFactory, SoftDeletes;

    protected $guarded = ['password_confirmation'];

    public function getMembershipType(){
        return $this->belongsTo(MembershipType::class, 'membership_type_id');
    }

    public function musicCategory()
    {
        return $this->belongsToMany(MusicCategory::class,'pivot_member_music_category','member_id','music_category_id')->withTimestamps();
    }

    public function instrument(){
    	return $this->hasMany(MemberInstrument::class, 'member_id');
    }

    public function photo(){
    	return $this->hasMany(MemberPhoto::class, 'member_id');
    }

    public function song(){
    	return $this->hasMany(MemberSong::class, 'member_id');
    }

    public function video(){
    	return $this->hasMany(MemberVideo::class, 'member_id');
    }

    public function image(){
        return $this->hasMany(MemberProfile::class, 'member_id');
    }

    public function memberGenere(){
        return $this->hasOne(MusicGenre::class, 'id','music_genre_id');
    }
}
