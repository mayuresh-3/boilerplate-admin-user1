<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Filters\FiltersUserPermission;
use App\Http\Requests\ContentlibraryRequest;
use App\Models\Contentlibrary;
use App\Transformers\ContentlibraryTransformer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class ContentlibraryController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/user/demo",
     *      operationId="getProjectsList",
     *      tags={"Projects"},
     *      summary="Get list of projects",
     *      description="Returns list of projects",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function index()
    {
        $contentlibrarys = QueryBuilder::for(Contentlibrary::class)
            ->allowedFilters([
                    'title'
                ]
            )
            ->allowedSorts(
                AllowedSort::field('title'),
            )
            ->jsonPaginate();

        $response = fractal()
            ->collection($contentlibrarys, new ContentlibraryTransformer(), 'data')
            ->paginateWith(new IlluminatePaginatorAdapter($contentlibrarys))->toArray();

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *      path="/api/user/test",
     *      operationId="testFunction",
     *      tags={"user"},
     *      summary="test summary",
     *      description="This is a test description",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function test()
    {
        return response('Hello World!!!', 200)
            ->header('Content-Type', 'text/plain');
    }

    public function store(ContentlibraryRequest $request)
    {
        // $roleName = $request->get('role');
        $contentlibraryData = $request->all();
        $contentlibraryData['created_by'] = auth()->user()->id;
        $contentlibraryData['advertiser_id'] = auth()->user()->id;
        $contentlibrary = Contentlibrary::create($contentlibraryData);
        //$contentlibrary->assignRole($roleName);

        return response()->json([
            'status' => 'success',
            'message' => 'Library data created successfully',
        ], Response::HTTP_CREATED);
    }

    public function show($id) {
        $contentlibrary = Contentlibrary::find($id);
        if (!$contentlibrary) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        $response = fractal()
            ->item($contentlibrary, new ContentlibraryTransformer(), 'data')->toArray();

        return response()->json($response,Response::HTTP_OK);
    }

    public function update(CampaignRequest $request, $id) {
        $user = Contentlibrary::find($id);
        $contentlibraryData = $request->all();
        $contentlibraryData['updated_by'] = auth()->user()->id;
        $user->update($contentlibraryData);

        return response()->json([
            'status' => 'success',
            'message' => 'Library data updated successfully',
        ], Response::HTTP_CREATED);
    }

    public function destroy($id) {
        $contentlibrary = Contentlibrary::find($id);
        $contentlibrary->forceDelete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function contentByAdvertiserId()
    {
        $campaigns = QueryBuilder::for(Contentlibrary::class)
            ->where('advertiser_id',auth()->user()->id)
            ->allowedFilters([
                    'title'
                ]
            )
            ->allowedSorts(
                AllowedSort::field('title'),
            )
            ->jsonPaginate();

        $response = fra()
            ->collection($campaigns, new Contentlibrary(), 'data')
            ->paginateWith(new IlluminatePaginatorAdapter($campaigns))->toArray();

        return response()->json($response, Response::HTTP_OK);
    }
}
