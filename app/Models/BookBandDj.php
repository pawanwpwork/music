<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BandDJEventType;
use App\Models\BandDjAgeGroup;

class BookBandDj extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['event_type_id','age_group_id'];

    protected $table 	= 'book_band_dj';

    protected $dates = ['deleted_at'];
    
    public function event_type()
    {
        return $this->belongsToMany(BandDJEventType::class,'pivot_band_dj_event_type','book_band_dj_id','event_type_id')->withTimestamps();
    }

    public function age()
    {
        return $this->belongsToMany(BandDjAgeGroup::class,'pivot_band_dj_event_age_group','book_band_dj_id','age_group_id')->withTimestamps();
    }
}
