<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
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
        $users = QueryBuilder::for(User::class)
            ->allowedFilters([
                    'name',
                    AllowedFilter::callback('email', function (Builder $query, $value) {
                        $query->where('email', 'LIKE', $value);
                    }),
                ]
            )
            ->allowedSorts(
                AllowedSort::field('name', 'email'),
                'name'
            )
            ->jsonPaginate();

        $response = fractal()
            ->collection($users, new UserTransformer(), 'data')
            ->paginateWith(new IlluminatePaginatorAdapter($users))->toArray();

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

    public function store(UserRequest $request)
    {
        $roleName = $request->get('role');
        $userData = $request->all();
        unset($userData['role']);
        unset($userData['confirmPassword']);
        unset($userData['acceptTerms']);
        $userData['password'] = Hash::make($userData['password']);
        $user = User::create($userData);
        $user->assignRole($roleName);

        return response()->json([
            'status' => 'success',
            'message' => 'Account created successfully',
        ], Response::HTTP_CREATED);
    }
}
