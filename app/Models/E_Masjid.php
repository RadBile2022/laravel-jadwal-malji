<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class E_Masjid extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','address','map'];
}
