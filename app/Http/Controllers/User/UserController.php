<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Filters\FiltersUserPermission;
use App\Http\Requests\UserRequest;
use App\Models\Advertiser;
use App\Models\User;
use App\Transformers\UserTransformer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->with('influencers')
            ->allowedFilters([
                    'firstName',
                    'email',
                    AllowedFilter::custom('role', new FiltersUserPermission()),
                ]
            )
            ->allowedSorts(
                AllowedSort::field('firstName', 'email'),
            )
            ->jsonPaginate();

        $response = fractal()
            ->collection($users, new UserTransformer(), 'data')
            ->paginateWith(new IlluminatePaginatorAdapter($users))->toArray();

        return response()->json($response, Response::HTTP_OK);
    }


    public function store(UserRequest $request)
    {
        $roleName = $request->get('role');
        $userData = $request->all();
        unset($userData['role']);
        unset($userData['confirmPassword']);
        unset($userData['acceptTerms']);
        $userData['password'] = Hash::make($userData['password']);
        $userData['created_by'] = optional(auth()->user())->id || 0;
        $user = User::create($userData);
        $user->assignRole($roleName);
        if ($roleName === 'advertiser') {
            Advertiser::create(['user_id' => $user->id ]);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Account created successfully',
        ], Response::HTTP_CREATED);
    }

    public function show($id) {
        $user = User::with('influencers.social')->find($id);
        if (!$user) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        $response = fractal()
            ->item($user, new UserTransformer(), 'data')->toArray();

        return response()->json($response,Response::HTTP_OK);
    }

    public function update(UserRequest $request, $id) {
        $user = User::find($id);
        $roleName = $request->get('role');
        if($roleName === 'advertiser') {
            $userAdvertiser = Advertiser::where('user_id', $user->id)->first();
            if(!$userAdvertiser) {
                Advertiser::create(['user_id' => $user->id ]);
            }
        }
        $userData = $request->all();
        unset($userData['role']);
        unset($userData['confirmPassword']);
        unset($userData['acceptTerms']);
        $userData['password'] = Hash::make($userData['password']);
        $userData['updated_by'] = optional(auth()->user())->id || 0;
        $user->update($userData);
        $user->syncRoles($roleName);

        return response()->json([
            'status' => 'success',
            'message' => 'Account created successfully',
            'data' => $user,
        ], Response::HTTP_CREATED);
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->forceDelete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
