<?php

namespace App\Transformers;

use App\Models\Advertiser;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class AdvertiserTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected array $defaultIncludes = [
    ];

    protected array $availableIncludes = [];
    /**
     * A Fractal transformer.
     *
     * @param User $users
     * @return array
     */
    public function transform(Advertiser $advertiser)
    {
        return [
            'user_id' => $advertiser->user_id,
            'firstName' =>  $advertiser->user->firstName,
        ];
    }

}
