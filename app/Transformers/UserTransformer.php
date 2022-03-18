<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include.
     *
     * @var array
     */
//    protected $availableIncludes = [
//        'roles',
//    ];

    /**
     * A Fractal transformer.
     *
     * @param User $users
     * @return array
     */
    public function transform(User $users)
    {
        return [
            'id' => $users->id,
            'name' => $users->name,
            'email' => $users->email,
            'created_at' => $users->created_at,
//            'roles' => $this->addRoleIds($users),

        ];
    }

//    public function includeRoles(User $users)
//    {
//        return $this->collection($users->roles, new RoleTransformer());
//    }
//
//    public function addRoleIds(User $users)
//    {
//        return $users->roles->pluck('id');
//    }
}
