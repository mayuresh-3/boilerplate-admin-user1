<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Filters\FiltersUserPermission;
use App\Http\Requests\CampaignRequest;
use App\Models\Campaign;
use App\Models\Campaign_content_mapp;
use App\Models\Campaign_influencers_map;
use App\Models\campaign_product_mapp;
use App\Product;
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
            ->with('contents')
            ->with('influencers')
            ->with('products')
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
        $campaign = Campaign::create($campaignData);

        $contents = $request->contents;
        if (count($contents) >0) {
            foreach ($contents as $key => $val) {
                $content = Campaign_content_mapp::create(['campaign_id'=> $campaign->id, 'content_lib_id'=>$val, 'created_by' => auth()->user()->id]);
            }
        }

        $influencers = $request->influencers;
        if (count($influencers) >0) {
            foreach ($influencers as $key => $val) {
                $content = Campaign_influencers_map::create(['influencer_id' =>$val , 'campaign_id'=> $campaign->id,  'created_by' => auth()->user()->id]);
            }
        }

        $products = $request->products;
        if (count($products) >0) {
            foreach ($products as $key => $val) {
                $content = campaign_product_mapp::create(['product_id' =>$val , 'campaign_id'=> $campaign->id,  'created_by' => auth()->user()->id]);
            }
        }
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

        $contents = $request->contents;
        $dbContents = $user->contents->pluck('id')->toarray();
/////////////////////////////////////
        if (count($contents) >0) {
            foreach ($contents as $key => $val) {
                if (!in_array($val, $dbContents)) {
                    $content = Campaign_content_mapp::insert(['campaign_id' => $id, 'content_lib_id' => $val, 'updated_by' => auth()->user()->id]);
                }
            }
        }

        if (count($dbContents) >0) {
            foreach ($dbContents as $k=> $v) {
                if (!in_array($v, $contents)) {
                    $d = Campaign_content_mapp::where('content_lib_id', $v)->where('campaign_id' , $id)->delete();
                }
            }
        }
////////////////////////////////
///
        $influencers = $request->influencers;
        $dbInfluencers = $user->influencers->pluck('id')->toarray();

        if (count($influencers) >0) {
            foreach ($influencers as $key => $val) {
                if (!in_array($val, $dbInfluencers)) {
                    $content = Campaign_influencers_map::insert(['campaign_id' => $id, 'influencer_id' => $val, 'updated_by' => auth()->user()->id]);
                }
            }
        }

        if (count($dbInfluencers) >0) {
            foreach ($dbInfluencers as $k=> $v) {
                if (!in_array($v, $influencers)) { echo $v."----".id;
                    $d = Campaign_influencers_map::where('influencer_id', $v)->where('campaign_id' , $id)->delete();
                }
            }
        }

        $products = $request->products;
        $dbProducts = $user->products->pluck('id')->toarray();
        if (count($products) >0) {
            foreach ($products as $key => $val) {
                if (!in_array($val, $dbProducts)) {
                    $content = Campaign_product_mapp::insert(['campaign_id' => $id, 'product_id' => $val, 'updated_by' => auth()->user()->id]);
                }
            }
        }

        if (count($dbProducts) >0) {
            foreach ($dbProducts as $k=> $v) {
                if (!in_array($v, $products)) {
                    $d = campaign_product_mapp::where('product_id', $v)->where('campaign_id' , $id)->delete();
                }
            }
        }

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
