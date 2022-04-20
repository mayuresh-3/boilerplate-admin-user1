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
            'media_type_id' => $proposals->media_type_id,
            'mediafile' => $proposals->mediafile,
            'created_at' => $proposals->created_at,
            'updated_at' => $proposals->updated_at,
            'status' => $proposals->status,
            'tags' => $proposals->tags,
            'media_type' => $this->addMediaType($proposals)
        ];
    }


    public function addMediaType(Contentlibrary $proposals)
    {
        return $proposals->mediaType()->pluck('media_type_name')->first();
    }
}
