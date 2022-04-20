<?php

namespace App\Serializer;

use League\Fractal\Serializer\ArraySerializer;

class CustomDataArraySerializer extends ArraySerializer
{
    /*
     * This class is for adding custom names for the data mapped by transformers
     */

    /**
     * Serialize a collection.
     */
    public function collection(?string $resourceKey, array $data): array
    {
        return ($resourceKey && $resourceKey != 'include') ? [$resourceKey => $data] : $data;
    }

    /**
     * Serialize an item.
     */
    public function item(?string $resourceKey, array $data): array
    {
        return ($resourceKey && $resourceKey != 'include') ? [$resourceKey => $data] : $data;
    }
}
