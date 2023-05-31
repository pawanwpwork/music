<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Member;

class Product extends Model
{
    use HasFactory, SoftDeletes;

//   protected $guarded = [];

protected $fillable = ['member_id','add_user_type','name','alias','description','meta_tag_title','meta_tag_description','meta_tag_keyword','product_tag','model','sku','locations','price','quantity',
                        'subtract_stock','out_of_stock','date_available','date_end','length','width','height','length_class','weight','weight_unit','status','sort_order','manufacturer','categories','downloads','related_products','image','back_image','total_days',
                        'per_day_rate','sub_total','created_at','updated_at','deleted_at','updated_by','created_by','is_featured','artist','weight_limit','category_ids'];

    public function category()
    {
        return $this->belongsToMany(Category::class,'category_product','product_id','category_id')->withTimestamps();
    }

    public function member()
    {
        return $this->belongsTo(Member::class,'member_id','id');
    }
}
