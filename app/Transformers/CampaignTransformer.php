<?php

namespace App\Transformers;

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
        'roles'
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
            'created_at' => $proposals->created_at,
            'advertiser_id' => $proposals->advertiser_id,
            'status' => $proposals->status,
        ];
    }

    public function includeRoles(Proposal $proposals)
    {
        return $this->collection($proposals->roles, new RoleTransformer());
    }

    public function addRoleIds(Proposal $proposals)
    {
        return $proposals->roles->pluck('id');
    }
}
