<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\InfluencerRequest;
use App\Models\Influencer;
use App\Models\User;
use Illuminate\Http\Response;

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
}
