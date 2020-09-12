<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = "members";
    protected $fillable = ["account_number", "name", "date_of_birth", "gender", "phone_number", "notes"];

    public function yogaClasses()
    {
        return $this->belongsToMany("App\Models\YogaClass", 'member_yoga', 'member_id', 'yoga_id');
    }

    public function walkingClasses()
    {
        return $this->belongsToMany("App\Models\WalkingClass", 'member_walking', 'member_id', 'walking_id');
    }

    public function healthIndexes()
    {
        return $this->hasMany("App\Models\HealthIndex", 'member_id', 'id');
    }
}
