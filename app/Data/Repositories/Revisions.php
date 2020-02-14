<?php

namespace App\Data\Repositories;

use App\Data\Models\Revision;
use App\Data\Models\Revision as RevisionModel;
use Illuminate\Http\Request;

class Revisions extends Base
{
    public $classesAndRoutes = [
        'App\Data\Models\Tribunal' => 'tribunais.show',
        'App\Data\Models\Acao' => 'acoes.show',
        'App\Data\Models\Juiz' => 'juizes.show',
        'App\Data\Models\Processo' => 'processos.show',
        'App\Data\Models\User' => 'users.show',
        'App\Data\Models\Andamento' => 'andamentos.show',
        'App\Data\Models\Opinion' => 'opinions.show',
        'App\Data\Models\OpinionSubject' => 'opinionSubjects.show',
        'App\Data\Models\Lei' => 'leis.show'
    ];

    protected $hideFields = ['remember_token', 'password'];

    /**
     * @var string
     */
    protected $model = RevisionModel::class;

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function search(Request $request)
    {
        return $this->searchFromRequest($request->get('pesquisa'));
    }

    public function last()
    {
        return $this->model
            ::orderBy('created_at', 'DESC')
            ->orderBy('id', 'DESC')
            ->first();
    }

    /**
     * @param null $search
     *
     * @return mixed
     */
    public function searchFromRequest($search = null)
    {
        return Revision::whereIn(
            'revisionable_type',
            collect($this->classesAndRoutes)->keys()
        )
            ->whereNotIn('key', $this->hideFields)
            ->orderBy('created_at', 'DESC')
            ->paginate(25);
    }

    /**
     * @param PackageInterface $package
     */
    public function hasPackage(PackageInterface $package)
    {
        // TODO: Implement hasPackage() method.
    }

    /**
     * @param $name
     * @param $constraint
     */
    public function findPackage($name, $constraint)
    {
        // TODO: Implement findPackage() method.
    }

    /**
     * @param $name
     * @param null $constraint
     */
    public function findPackages($name, $constraint = null)
    {
        // TODO: Implement findPackages() method.
    }

    public function getPackages()
    {
        // TODO: Implement getPackages() method.
    }

    public function count()
    {
        // TODO: Implement count() method.
    }
}
