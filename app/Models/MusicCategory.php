<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MusicCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = 'music_categories';
}
