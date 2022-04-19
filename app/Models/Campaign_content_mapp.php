<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign_content_mapp extends Model
{
    protected $table = 'campaign_content_mapp';

    //
    protected $fillable = [
        'campaign_id','content_lib_id','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];
}
