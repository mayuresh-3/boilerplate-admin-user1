<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\InfluencerRequest;
use App\Models\Influencer;
use App\Models\Tamayou_instagramprofiles;
use App\Models\User;
use App\Models\User_influencer_mapping;
use App\Transformers\TamayouInstagramprofilesTransformer;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;

class InfluencerController extends Controller
{

    public function store(InfluencerRequest $request)
    {

        $indluencerData = $request->all();

        $influencer = Influencer::create($indluencerData);

        return response()->json([
            'status' => 'success',
            'message' => 'Influencer detail created successfully',
        ], Response::HTTP_CREATED);
    }


    public function destroy($id) {
        $user = User::find($id);
        $user->forceDelete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function getTamayouInfluencer($id)
    {
        $influencer = Tamayou_instagramprofiles::find($id);
        //$influencer = Tamayou_instagramprofiles::where('id',$id)->get(['id','email_1','full_name', 'handle','frequent_location','followers']);

        if (!$influencer) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        $name = explode(' ',$influencer->full_name, 2);

        $response = fractal()
            ->item($influencer, new TamayouInstagramprofilesTransformer(), 'data')->toArray();

        $data = $response['data'];
        $response['data'] =[];
        $response['data']['firstName'] = $data['id'];
        $response['data']['firstName'] = $name[0];
        $response['data']['lastName'] = $name[1];
        $response['data']['email'] = $data['email_1'];
        $response['data']['handle'] = $data['handle'];
        $response['data']['avatar'] = $data['avatar'];
        $response['data']['location'] = $data['frequent_location'];
        $response['data']['followers'] = $data['followers'];
        $response['data']['medias'] = [];
        return response()->json($response,Response::HTTP_OK);
    }

    public function storeInfluencerMap(InfluencerRequest $request)
    {
        $userData = $request->all();
        $indluencerData = $request->all();
        $roleName = $request->get('role');
        $userData = $request->all();
        unset($userData['role']);
        unset($userData['confirmPassword']);
        unset($userData['acceptTerms']);
        $userData['password'] = Hash::make($userData['password']);
        $userData['created_by'] = optional(auth()->user())->id || 0;
        $user = User::create($userData);
        $user->assignRole($roleName);

        $indluencerData['user_id'] = $user->id;
        $indluencerData['tamayou_influencer_id'] = $request->tamayou_id;

        $influencer = User_influencer_mapping::create($indluencerData);

        return response()->json([
            'status' => 'success',
            'message' => 'Influencer mapp created successfully',
        ], Response::HTTP_CREATED);
    }

    public function getTamayouInfluencerDetails($id)
    {
        $influencer = QueryBuilder::for(Tamayou_instagramprofiles::class)
                        ->with('categories')
                        ->where('id',$id)->first();


        if (!$influencer) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        $name = explode(' ',$influencer->full_name, 2);

        $response = fractal()
            ->item($influencer, new TamayouInstagramprofilesTransformer(), 'data')->toArray();

        $data = $response['data'];
        $response['data'] =[];
        $response['data']['firstName'] = $data['id'];
        $response['data']['firstName'] = $name[0];
        $response['data']['lastName'] = $name[1];
        $response['data']['email'] = $data['email_1'];
        $response['data']['handle'] = $data['handle'];
        $response['data']['avatar'] = $data['avatar'];
        $response['data']['location'] = $data['frequent_location'];
        $response['data']['followers'] = $data['followers'];
        $response['data']['medias'] = [];
        $response['data']['categories'] = $data['categories'];
        $response['data']['following'] = $data['following'];
        $response['data']['engagement'] = $data['engagement'];
        $response['data']['postsPerWeek'] = $data['postsPerWeek'];
        $response['data']['bio'] = $data['bio'];
        return response()->json($response,Response::HTTP_OK);
    }
}
