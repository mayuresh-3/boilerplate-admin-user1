<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tamayou_instagramprofiles extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','handle', 'link', 'full_name', 'followers', 'following', 'post_engagement', 'estimated_cost_of_photo', 'estimated_cost_of_video',
        'number_of_posts', 'quality_score','follower_growth_rate','status'
    ];

    protected $table = 'tamayou_instagramprofiles';

    public $timestamps = false;

}
