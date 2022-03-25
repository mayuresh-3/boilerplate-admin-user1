<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Filters\FiltersUserPermission;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Transformers\ProductTransformer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
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
        $campaigns = QueryBuilder::for(Product::class)
            ->allowedFilters([
                    'title'
                ]
            )
            ->allowedSorts(
                AllowedSort::field('title'),
            )
            ->jsonPaginate();

        $response = fractal()
            ->collection($campaigns, new ProductTransformer(), 'data')
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

    public function store(ProductRequest $request)
    {
        // $roleName = $request->get('role');
        $productData = $request->all();
        $productData['created_by'] = auth()->user()->id;
        $productData['advertiser_id'] = auth()->user()->id;
        $proposal = Product::create($productData);
        //$proposal->assignRole($roleName);

        return response()->json([
            'status' => 'success',
            'message' => 'Campaign created successfully',
        ], Response::HTTP_CREATED);
    }

    public function show($id) {
        $proposal = Product::find($id);
        if (!$proposal) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        $response = fractal()
            ->item($proposal, new ProductTransformer(), 'data')->toArray();

        return response()->json($response,Response::HTTP_OK);
    }

    public function update(ProductRequest $request, $id) {
        $user = Product::find($id);
        $productData = $request->all();
        $productData['updated_by'] = auth()->user()->id;
        $user->update($productData);

        return response()->json([
            'status' => 'success',
            'message' => 'Campaign updated successfully',
        ], Response::HTTP_CREATED);
    }
    public function destroy($id) {
        $proposal = Product::find($id);
        $proposal->forceDelete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /*public function campaignByProposalId($proposalId)
    {
        $campaigns = QueryBuilder::for(Product::class)
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
    }*/
}
