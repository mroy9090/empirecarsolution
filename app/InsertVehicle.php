<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsertVehicle extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
}
