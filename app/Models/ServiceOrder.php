<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
use App\Models\Product;

class ServiceOrder extends Model
{
    use HasFactory;


    protected $guarded = [];

     protected $table = 'service_order';

    public function member(){
        return $this->hasOne(Member::class, 'id','member_id');
    }

    public function product(){
        return $this->hasOne(Product::class, 'id','service_id');
    }
}
