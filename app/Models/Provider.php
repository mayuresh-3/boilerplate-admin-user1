<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = ['provider','provider_id','user_id','avatar'];
    protected $hidden = ['created_at','updated_at'];
}
