<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberInstrument extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = 'member_instruments';
}
