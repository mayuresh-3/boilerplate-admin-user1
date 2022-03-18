<?php

namespace App\Transformers;

use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use Spatie\Permission\Models\Role;

class RoleTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected array $availableIncludes = [
        'permissions',
    ];

    private $permissions;
    /**
     * @var bool
     */
    private $includeIdsOnly;

    public function __construct($permissions = false, $includeIdsOnly = false)
    {
        $this->permissions = $permissions;
        $this->includeIdsOnly = $includeIdsOnly;
    }

    /**
     * A Fractal transformer.
     *
     * @param Role $role
     * @return array
     */
    public function transform(Role $role)
    {
        return [
            'id' => $role->id,
            'name' => $role->name,
//            'permissions' => $this->addPermissionIds($role),
        ];
    }

    public function addPermissionIds(Role $role)
    {
        return $role->permissions->pluck('id');
    }

    /**
     * @param Role $role
     * @return Collection
     */
    public function includePermissions(Role $role)
    {
        if (! $this->permissions) {
            return $this->collection($role->permissions, new PermissionTransformer());
        }

        $permissionIds = $role->permissions->pluck('id')->toArray();

        $permissions = $this->permissions->map(function ($item) use ($permissionIds) {
            if (in_array($item->id, $permissionIds)) {
                $item->selected = true;

                return $item;
            }

            $item->selected = false;

            return $item;
        });

        return $this->collection($permissions, new PermissionTransformer());
    }
}
