<?php

namespace App\Transformers;

use App\Models\Advertiser;
use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{

    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected array $defaultIncludes = [
    ];
    protected array $availableIncludes = [];
    /**
     * A Fractal transformer.
     *
     * @param Proposal $products
     * @return array
     */
    public function transform(Product $products)
    {
        return [
            'id' => $products->id,
            'title' => $products->title,
            'description' => $products->description,
            'status' => $products->status,
        ];
    }
}
