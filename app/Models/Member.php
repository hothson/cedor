<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = "members";
    protected $fillable = ["account_number", "name", "age", "gender", "phone_number", "notes"];
}
