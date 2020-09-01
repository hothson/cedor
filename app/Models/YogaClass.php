<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YogaClass extends Model
{
    protected $table = "yoga_classes";
    protected $fillable = ["instructor", "attendent", "vitamin_D", "started_at", "ended_at", "notes"];

    function members()
    {
        return $this->belongsToMany('App\Models\Member', 'member_yoga', 'yoga_id', 'member_id');
    }
}
