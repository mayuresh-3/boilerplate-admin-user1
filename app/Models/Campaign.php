<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Campaign extends Model
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','description','start_date', 'end_date', 'budget', 'advertiser_id', 'proposal_id','status'
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
    public function proposal()
    {
       return $this->belongsTo(Proposal::class,'id','proposal_id');
    }

    public function contents()
    {
        return $this->belongsToMany(Contentlibrary::class, 'campaign_content_mapp', 'campaign_id', 'content_lib_id');
    }

    public function influencers()
    {
        return $this->belongsToMany(Influencer::class, 'campaign_influencers_map', 'influencer_id', 'influencer_id');
    }
}
