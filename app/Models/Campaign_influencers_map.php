<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign_influencers_map extends Model
{
    protected $table = 'campaign_influencers_map';

    //
    protected $fillable = [
        'influencer_id','campaign_id','status'
    ];

}
