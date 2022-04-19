<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Mediatype;
use App\Transformers\MediatypeTransformer;
use Illuminate\Http\Response;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class MediatypeController extends Controller
{

    public function index()
    {
        $proposals = QueryBuilder::for(Mediatype::class)
            ->allowedFilters([
                    'media_type_name',
                ]
            )
            ->allowedSorts(
                AllowedSort::field('media_type_name'),
            )
            ->jsonPaginate();

        $response = fractal()
            ->collection($proposals, new MediatypeTransformer(), 'data')
            ->paginateWith(new IlluminatePaginatorAdapter($proposals))->toArray();

        return response()->json($response, Response::HTTP_OK);
    }

}
