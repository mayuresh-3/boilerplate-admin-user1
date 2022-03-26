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
        $this->belongsTo(Proposal::class,'id','proposal_id');
    }

    public function contents()
    {
        $this->belongsToMany(Contentlibrary::class, 'campaign_content_mapp', 'campaign_id', 'content_liv_id');
    }
}
