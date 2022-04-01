<?php

namespace App\Transformers;

use App\Models\Campaign;
use App\Models\Proposal;
use League\Fractal\TransformerAbstract;

class CampaignTransformer extends TransformerAbstract
{


    protected array $defaultIncludes = [
    ];
    /**
     * A Fractal transformer.
     *
     * @param Proposal $campagin
     * @return array
     */
    public function transform(Campaign $campaign)
    {
        return [
            'id' => $campaign->id,
            'title' => $campaign->title,
            'description' => $campaign->description,
            'start_date' => $campaign->start_date,
            'end_date' => $campaign->end_date,
            'budget' => $campaign->budget,
            'created_at' => $campaign->created_at,
            'updated_at' => $campaign->updated_at,
            'advertiser_id' => $campaign->advertiser_id,
            'proposal_id' => $campaign->proposal_id,
            'status' => $campaign->status,
            'contents' => $this->addContents($campaign),
            'influencers' => $this->addInfluencers($campaign),
            'products' => $this->addProducts($campaign)
        ];
    }

    public function addContents(Campaign $campaign)
    {
        return $campaign->contents->pluck('id');
    }

    public function addInfluencers(Campaign $campaign)
    {
        return $campaign->influencers->pluck('id');
    }
    public function addProducts(Campaign $campaign)
    {
        return $campaign->products->pluck('id');
    }
}
