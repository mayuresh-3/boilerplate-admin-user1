<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Influencer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'social_media_id', 'link', 'followers', 'engagement', 'videos', 'avg_views_per_video', 'avg_views_per_video_week',
        'email', 'status'
    ];

    protected $table = 'influencers_details';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function social()
    {
        return $this->belongsTo(Social::class, 'social_media_id', 'id');
    }
}
