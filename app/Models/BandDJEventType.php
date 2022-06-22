<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookBandDj;

class BandDJEventType extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table 	= 'band_dj_event_types';
    
    public function banddj()
    {
        return $this->belongsTo(BookBandDj::class);
    }
}
