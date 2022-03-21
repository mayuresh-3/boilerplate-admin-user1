<?php

namespace App\Transformers;

use App\Models\Proposal;
use League\Fractal\TransformerAbstract;

class ProposalTransformer extends TransformerAbstract
{


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
            'min_budget' => $proposals->min_budget,
            'max_budget' => $proposals->max_budget,
            'created_at' => $proposals->created_at,
            'updated_at' => $proposals->updated_at,
            'advertiser_id' => $proposals->advertiser_id,
            'status' => $proposals->status
        ];
    }

}
