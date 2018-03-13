<?php

namespace App\Data\Presenters;

use McCool\LaravelAutoPresenter\BasePresenter;

class RevisionPresenter extends BasePresenter
{
    protected $routes = [
        'App\Data\Models\TipoUsuario' => null,
        'App\Data\Models\Tribunal' => 'tribunais.show',
        'App\Data\Models\Acao' => 'acoes.show',
        'App\Data\Models\TipoJuiz' => null,
        'App\Data\Models\Juiz' => 'juizes.show',
        'App\Data\Models\Meio' => null,
        'App\Data\Models\Processo' => 'processos.show',
        'App\Data\Models\User' => null,
    ];

    public function revisionable()
    {
        $parts = explode('\\', $this->wrappedObject->revisionable_type);

        return end(
            $parts
        );
    }

    public function link()
    {
        if (is_null($routeName = $this->routes[$this->wrappedObject->revisionable_type])) {
            return null;
        }

        return route($routeName, $this->wrappedObject->revisionable_id);
    }
}