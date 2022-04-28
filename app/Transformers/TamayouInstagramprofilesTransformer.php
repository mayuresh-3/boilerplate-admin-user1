<?php

namespace App\Transformers;

use App\Models\Advertiser;
use App\Models\Influencer;
use App\Models\Tamayou_instagramprofiles;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class TamayouInstagramprofilesTransformer extends TransformerAbstract
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
    public function transform(Tamayou_instagramprofiles $tamayou_instagramprofiles)
    {
        return [
            'id' => $tamayou_instagramprofiles->id,
            'handle' => $tamayou_instagramprofiles->handle,
            'link' => $tamayou_instagramprofiles->link,
            'full_name' => $tamayou_instagramprofiles->full_name,
            'followers' => $tamayou_instagramprofiles->followers,
            'following' => $tamayou_instagramprofiles->following,
            'post_engagement' => $tamayou_instagramprofiles->post_engagement,
            'estimated_cost_of_photo' => $tamayou_instagramprofiles->estimated_cost_of_photo,
            'estimated_cost_of_video' => $tamayou_instagramprofiles->estimated_cost_of_video,
            'number_of_posts' => $tamayou_instagramprofiles->number_of_posts,
            'quality_score' => $tamayou_instagramprofiles->quality_score,
            'follower_growth_rate' => $tamayou_instagramprofiles->follower_growth_rate,
            'status'=> $tamayou_instagramprofiles->status,
            'email_1' =>$tamayou_instagramprofiles->email_1,
            'frequent_location'=>$tamayou_instagramprofiles->frequent_location,
            'avatar'=>$tamayou_instagramprofiles->avatar,
            'engagement'=>$tamayou_instagramprofiles->engagement,
            'postsPerWeek'=>$tamayou_instagramprofiles->postsPerWeek,
            'bio'=>$tamayou_instagramprofiles->bio,
            'categories'=>$this->addCategories($tamayou_instagramprofiles)
        ];
    }

    public function addCategories(Tamayou_instagramprofiles $tamayou_instagramprofiles)
    {
        return $tamayou_instagramprofiles->categories->pluck('category_name');
    }


}
