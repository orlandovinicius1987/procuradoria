<?php

namespace App\Data\Repositories;

use App\Models\Revision;
use App\Models\Revision as RevisionModel;
use Illuminate\Http\Request;

class Revisions extends Base
{
    public $classesAndRoutes = [
        'App\Models\Tribunal' => 'tribunais.show',
        'App\Models\Acao' => 'acoes.show',
        'App\Models\Juiz' => 'juizes.show',
        'App\Models\Processo' => 'processos.show',
        'App\Models\User' => 'users.show',
        'App\Models\Andamento' => 'andamentos.show',
        'App\Models\Opinion' => 'opinions.show',
        'App\Models\OpinionSubject' => 'opinionSubjects.show',
        'App\Models\Lei' => 'leis.show',
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
        return Revision::whereIn('revisionable_type', collect($this->classesAndRoutes)->keys())
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
