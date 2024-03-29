<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FiltersUserPermission implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->whereHas('roles', function (Builder $query) use ($value) {
            $query->where('name', $value);
        });
    }
}
