<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookBandDj;

class BandDjAgeGroup extends Model
{
    use HasFactory;

    protected $guarded 	= [];

    protected $table 	= 'band_dj_age_groups';
    
    public function banddj()
    {
        return $this->belongsTo(BookBandDj::class);
    }
}
