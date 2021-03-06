<?php

namespace App\Http\Controllers;

use App\Data\Repositories\Andamentos as AndamentosRepository;
use Illuminate\Http\Request;

class Agenda extends Controller
{
    /**
     * @var AndamentosRepository
     */
    private $andamentosRepository;

    /**
     * Agenda constructor.
     *
     * @param AndamentosRepository $andamentosRepository
     */
    public function __construct(AndamentosRepository $andamentosRepository)
    {
        $this->andamentosRepository = $andamentosRepository;
    }

    /**
     * @param AndamentosRepository $andamentosRepository
     * @param Request              $request
     *
     * @return $this
     */
    public function index(
        AndamentosRepository $andamentosRepository,
        Request $request
    ) {
        $pesquisa = $request->get('pesquisa');

        if (empty($pesquisa)) {
            return view('agenda.index');
        } else {
            return view('andamentos.index')
                ->with('pesquisa', $pesquisa)
                ->with('andamentos', $andamentosRepository->search($request));
        }
    }

    /**
     * @return mixed
     */
    public function feed()
    {
//        return $this->andamentosRepository->feedForFullCalendar();
    }
}
