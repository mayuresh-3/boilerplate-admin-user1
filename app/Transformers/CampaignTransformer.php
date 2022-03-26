<?php

namespace App\Transformers;

use App\Models\Campaign;
use App\Models\Proposal;
use League\Fractal\TransformerAbstract;

class CampaignTransformer extends TransformerAbstract
{


    protected array $defaultIncludes = [
        'contents',
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
            'status' => $campaign->status
        ];
    }

    public function includeContents(Campaign $campaign)
    {
        return $this->collection($campaign->contents, new ContentlibraryTransformer());
    }
}
