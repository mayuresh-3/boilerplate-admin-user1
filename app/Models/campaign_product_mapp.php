<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class campaign_product_mapp extends Model
{
    protected $table = 'campaign_product_mapp';

    //
    protected $fillable = [
        'campaign_id','product_id','status'
    ];
}
