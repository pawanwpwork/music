<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
use App\Models\OrderProduct;
use App\Models\Country;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function member(){
    	return $this->hasOne(Member::class, 'id','member_id');
    }

    public function product(){
    	return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public function country(){
    	return $this->hasOne(Country::class, 'id','country_id');
    }
}
