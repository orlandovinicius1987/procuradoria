<?php

namespace App\Data\Presenters;

use App\Data\Repositories\Revisions;
use McCool\LaravelAutoPresenter\BasePresenter;

class RevisionPresenter extends BasePresenter
{
    /**
     * @return mixed
     */
    private function getRouteName()
    {
        $routes = app(Revisions::class)->classesAndRoutes;

        if (!isset($routes[$this->wrappedObject->revisionable_type])) {
            return null;
        }

        return $routes[$this->wrappedObject->revisionable_type];
    }

    /**
     * @return mixed
     */
    public function revisionable()
    {
        $parts = explode('\\', $this->wrappedObject->revisionable_type);

        return end($parts);
    }

    /**
     * @return string|void
     */
    public function link()
    {
        if (is_null($routeName = $this->getRouteName())) {
            return;
        }

        return route($routeName, $this->wrappedObject->revisionable_id);
    }
}
