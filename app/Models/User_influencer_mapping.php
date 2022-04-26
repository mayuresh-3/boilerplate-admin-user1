<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_influencer_mapping extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id ', 'user_id', 'tamayou_influencer_id', 'instagram_profile_flag'
    ];

    protected $table = 'user_influencer_mapping';

    public $timestamps = false;
}
