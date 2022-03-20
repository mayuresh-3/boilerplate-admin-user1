<?php

namespace App\Transformers;

use App\Models\Contentlibrary;
use App\Models\Proposal;
use League\Fractal\TransformerAbstract;

class ContentlibraryTransformer extends TransformerAbstract
{


    protected array $availableIncludes = [];
    /**
     * A Fractal transformer.
     *
     * @param Proposal $proposals
     * @return array
     */
    public function transform(Contentlibrary $proposals)
    {
        return [
            'id' => $proposals->id,
            'title' => $proposals->title,
            'description' => $proposals->description,
            'dimension' => $proposals->dimension,
            'media_type' => $proposals->media_type,
            'mediafile' => $proposals->mediafile,
            'created_at' => $proposals->created_at,
            'updated_at' => $proposals->updated_at,
            'status' => $proposals->status
        ];
    }

}
