<?php

namespace App\Transformers;

use App\Models\Advertiser;
use App\Models\Influencer;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class InfluencerTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected array $defaultIncludes = [];

    protected array $availableIncludes = [];
    /**
     * A Fractal transformer.
     *
     * @param User $users
     * @return array
     */
    public function transform(Influencer $advertiser)
    {
        return [
            'influencer_id' => $advertiser->user_id,
            'social_media_id' => $advertiser->social_media_id,
            'social' => $this->getSocialName($advertiser)[0],
            'link' => $advertiser->link,
            'followers' => $advertiser->followers,
            'engagement' => $advertiser->engagement,
            'videos' => $advertiser->videos,
            'avg_views_per_video' => $advertiser->avg_views_per_video,
            'avg_views_per_video_week' => $advertiser->avg_views_per_video_week,
            'firstName' => $advertiser->user->firstName,
            'lastName' => $advertiser->user->lastName,
            'email' => $advertiser->user->email,
            'photo' => $advertiser->user->photo,
        ];
    }
    public function getSocialName(Influencer $influencer)
    {
        return $influencer->social->pluck('name');
    }

}
