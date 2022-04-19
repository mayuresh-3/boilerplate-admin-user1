<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

    protected $table = 'advertisers_details';

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function contents()
    {
        return $this->hasMany(Contentlibrary::class);
    }

}
