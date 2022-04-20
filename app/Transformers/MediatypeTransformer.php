<?php

namespace App\Transformers;

use App\Models\Contentlibrary;
use App\Models\Mediatype;
use App\Models\Proposal;
use League\Fractal\TransformerAbstract;

class MediatypeTransformer extends TransformerAbstract
{


    protected array $availableIncludes = [];
    /**
     * A Fractal transformer.
     *
     * @param Proposal $proposals
     * @return array
     */
    public function transform(Mediatype $proposals)
    {
        return [
            'media_type_id' => $proposals->media_type_id,
            'media_type_name' => $proposals->media_type_name,
            'extension' => $proposals->extension,
            'status' => $proposals->status
        ];
    }

}
