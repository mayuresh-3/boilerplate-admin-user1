<?php

namespace App\Transformers;

use App\Models\Advertiser;
use App\Models\Proposal;
use League\Fractal\TransformerAbstract;

class ProposalTransformer extends TransformerAbstract
{

    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'campaigns',
        'advertiser',
    ];
    protected array $availableIncludes = [];
    /**
     * A Fractal transformer.
     *
     * @param Proposal $proposals
     * @return array
     */
    public function transform(Proposal $proposals)
    {
        return [
            'id' => $proposals->id,
            'title' => $proposals->title,
            'description' => $proposals->description,
            'start_date' => $proposals->start_date,
            'end_date' => $proposals->end_date,
            'budget' => $proposals->budget,
            'created_at' => $proposals->created_at,
            'updated_at' => $proposals->updated_at,
            'status' => $proposals->status,
        ];
    }

    public function includeCampaigns(Proposal $proposal)
    {
        return $this->collection($proposal->campaigns, new CampaignTransformer());
    }
    public function includeAdvertiser(Proposal $proposals)
    {
        return $this->item($proposals->advertiser, new AdvertiserTransformer());
    }
}
