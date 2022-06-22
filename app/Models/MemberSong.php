<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Member;

class MemberSong extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = [];

    protected $table = 'member_songs';


    public function member(){
    	return $this->hasOne(Member::class, 'id','member_id');
    }
}
