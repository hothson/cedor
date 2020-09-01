<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalkingClass extends Model
{
    protected $table = "walking_classes";
    protected $fillable = ["instructor", "attendent", "vitamin_D", "started_at", "ended_at", "notes"];

    function members()
    {
        return $this->belongsToMany('App\Models\Member', 'member_walking', 'walking_id', 'member_id');
    }
}
