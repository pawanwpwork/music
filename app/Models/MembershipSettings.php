<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MembershipType;

class MembershipSettings extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = [];

    protected $table = 'membership_settings';

    public function membershipType(){
        return $this->belongsTo(MembershipType::class);
    }
}
