<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Filters\FiltersUserPermission;
use App\Http\Requests\CampaignRequest;
use App\Models\Campaign;
use App\Transformers\CampaginTransformer;
use App\Transformers\CampaignTransformer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class CampaignController extends Controller
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
        $campaigns = QueryBuilder::for(Campaign::class)
            ->allowedFilters([
                    'title'
                ]
            )
            ->allowedSorts(
                AllowedSort::field('title'),
            )
            ->jsonPaginate();

        $response = fractal()
            ->collection($campaigns, new CampaignTransformer(), 'data')
            ->paginateWith(new IlluminatePaginatorAdapter($campaigns))->toArray();

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

    public function store(CampaignRequest $request)
    {
        // $roleName = $request->get('role');
        $campaignData = $request->all();
        $campaignData['created_by'] = auth()->user()->id;
        $campaignData['advertiser_id'] = auth()->user()->id;
        $proposal = Campaign::create($campaignData);
        //$proposal->assignRole($roleName);

        return response()->json([
            'status' => 'success',
            'message' => 'Campaign created successfully',
        ], Response::HTTP_CREATED);
    }

    public function show($id) {
        $proposal = Campaign::find($id);
        if (!$proposal) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        $response = fractal()
            ->item($proposal, new CampaignTransformer(), 'data')->toArray();

        return response()->json($response,Response::HTTP_OK);
    }

    public function update(CampaignRequest $request, $id) {
        $user = Campaign::find($id);
        $campaignData = $request->all();
        $campaignData['updated_by'] = auth()->user()->id;
        $user->update($campaignData);

        return response()->json([
            'status' => 'success',
            'message' => 'Campaign updated successfully',
        ], Response::HTTP_CREATED);
    }
    public function destroy($id) {
        $proposal = Campaign::find($id);
        $proposal->forceDelete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function campaignByProposalId($proposalId)
    {
        $campaigns = QueryBuilder::for(Campaign::class)
            ->where('proposal_id',$proposalId)
            ->allowedFilters([
                    'title'
                ]
            )
            ->allowedSorts(
                AllowedSort::field('title'),
            )
            ->jsonPaginate();

        $response = fractal()
            ->collection($campaigns, new CampaignTransformer(), 'data')
            ->paginateWith(new IlluminatePaginatorAdapter($campaigns))->toArray();

        return response()->json($response, Response::HTTP_OK);
    }
}
