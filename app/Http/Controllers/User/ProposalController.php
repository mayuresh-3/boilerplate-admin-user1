<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Filters\FiltersUserPermission;
use App\Http\Requests\ProposalRequest;
use App\Models\Proposal;
use App\Transformers\ProposalTransformer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class ProposalController extends Controller
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
        $proposals = QueryBuilder::for(Proposal::class)
            ->allowedFilters([
                    'title'
                ]
            )
            ->allowedSorts(
                AllowedSort::field('title'),
            )
            ->jsonPaginate();

        $response = fractal()
            ->collection($proposals, new ProposalTransformer(), 'data')
            ->paginateWith(new IlluminatePaginatorAdapter($proposals))->toArray();

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

    public function store(ProposalRequest $request)
    {
       // $roleName = $request->get('role');
        $proposalData = $request->all();
        $proposalData['created_by'] = auth()->user()->id;
        $proposalData['advertiser_id'] = auth()->user()->id;
        $proposal = Proposal::create($proposalData);
        //$proposal->assignRole($roleName);

        return response()->json([
            'status' => 'success',
            'message' => 'Proposal created successfully',
        ], Response::HTTP_CREATED);
    }

    public function show($id) {
        $proposal = Proposal::find($id);
        if (!$proposal) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        $response = fractal()
            ->item($proposal, new ProposalTransformer(), 'data')->toArray();

        return response()->json($response,Response::HTTP_OK);
    }

    public function update(ProposalRequest $request, $id) {
        $user = Proposal::find($id);
        $proposalData = $request->all();
        $proposalData['updated_by'] = auth()->user()->id;
        $user->update($proposalData);

        return response()->json([
            'status' => 'success',
            'message' => 'Proposal updated successfully',
        ], Response::HTTP_CREATED);
    }
    public function destroy($id) {
        $proposal = Proposal::find($id);
        $proposal->forceDelete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
