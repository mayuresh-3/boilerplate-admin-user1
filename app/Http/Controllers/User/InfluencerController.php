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
        $contentlibrary = Tamayou_instagramprofiles::find($id);
        if (!$contentlibrary) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        $response = fractal()
            ->item($contentlibrary, new TamayouInstagramprofilesTransformer(), 'data')->toArray();

        return response()->json($response,Response::HTTP_OK);
    }

    public function storeInfluencerMap(InfluencerRequest $request)
    {
        $userData = $request->all();
        $indluencerData = $request->all();
        /*$roleName = $request->get('role');
        $userData = $request->all();
        unset($userData['role']);
        unset($userData['confirmPassword']);
        unset($userData['acceptTerms']);
        $userData['password'] = Hash::make($userData['password']);
        $userData['created_by'] = optional(auth()->user())->id || 0;
        $user = User::create($userData);
        $user->assignRole($roleName);*/

       $indluencerData['user_id'] = $request->id;
        $indluencerData['tamayou_influencer_id'] = $request->tamayou_id;

        $influencer = User_influencer_mapping::create($indluencerData);

        return response()->json([
            'status' => 'success',
            'message' => 'Influencer mapp created successfully',
        ], Response::HTTP_CREATED);
    }
}
