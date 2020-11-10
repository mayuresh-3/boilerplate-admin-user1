<?php

namespace App\Traits;

use Illuminate\Support\Facades\Request;

trait Authorizable
{
    private $abilities = [
        'index' => 'view',
        'show' => 'view',
        'update' => 'edit',
        'create' => 'add',
        'store' => 'add',
        'destroy' => 'delete',
    ];

    /**
     * Override of callAction to perform the authorization before.
     *
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function callAction($method, $parameters)
    {
        if ($ability = $this->getAbility($method)) {
            $this->authorize($ability);
        }

        return parent::callAction($method, $parameters);
    }

    /**
     * @param $method
     * @return string|null
     */
    public function getAbility($method)
    {
        $routeName = explode('.', Request::route()->getName());

        $action = data_get($this->getAbilities(), $method);

        return $action ? $action . '_' . $routeName[0] : null;
    }

    /**
     * @return array
     */
    private function getAbilities()
    {
        return $this->abilities;
    }

    /**
     * @param $abilities
     */
    public function setAbilities($abilities)
    {
        $this->abilities = $abilities;
    }
}
