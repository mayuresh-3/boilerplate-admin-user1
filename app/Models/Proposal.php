<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Proposal extends Model
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','description','start_date', 'end_date', 'budget', 'advertiser_id','status'
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

    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class, 'advertiser_id','user_id');
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function scopeCreatedAtBefore(Builder $query, $date): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date));
    }

    public function scopeCreatedAtBetween(Builder $query, $startdate, $enddate): Builder
    {
        return $query->whereBetween('created_at', [$startdate, $enddate]);
    }

    public function scopeStartDateBefore(Builder $query, $date): Builder
    {
        return $query->where('start_date', '<=', Carbon::parse($date));
    }

    public function scopeStartDateBetween(Builder $query, $startdate, $enddate): Builder
    {
        return $query->whereBetween('start_date', [$startdate, $enddate]);
    }

}
