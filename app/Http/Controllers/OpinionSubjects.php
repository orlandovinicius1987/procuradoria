<?php

namespace App\Http\Controllers;

use App\Models\OpinionSubject as OpinionSubjectModel;
use App\Data\Repositories\OpinionSubjects as OpinionSubjectsRepository;
use App\Http\Requests\OpinionSubjectUpdate as OpinionSubjectUpdateRequest;
use App\Http\Requests\OpinionSubjectStore as OpinionSubjectStoreRequest;
use Illuminate\Http\Request;

class OpinionSubjects extends Controller
{
    /**
     * @var OpinionSubjectsRepository
     */
    private $repository;

    /**
     * OpinionSubjects constructor.
     *
     * @param OpinionSubjectsRepository $repository
     */
    public function __construct(OpinionSubjectsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return $this
     */
    public function create()
    {
        $repository = app(OpinionSubjectsRepository::class);
        return view('opinionSubjects.form')
            ->with(['opinionSubject' => $this->repository->new()])
            ->with(
                'opinionSubjectsFormAttributes',
                $this->repository->formAttributes()
            )
            ->with('root', $repository->getRoot());
    }

    /**
     * @param OpinionSubjectRequest     $request
     * @param OpinionSubjectsRepository $repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(
        OpinionSubjectStoreRequest $request,
        OpinionSubjectsRepository $repository
    ) {
        $repository->createFromRequest($request);

        return redirect()
            ->route('opinionSubjects.index')
            ->with($this->getSuccessMessage());
    }

    /**
     * @param OpinionSubjectRequest     $request
     * @param OpinionSubjectsRepository $repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(
        OpinionSubjectUpdateRequest $request,
        OpinionSubjectsRepository $repository
    ) {
        return $this->store($request, $repository);
    }

    /**
     * @param OpinionSubjectsRepository $opinionSubjects
     * @param Request                   $request
     *
     * @return $this|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(
        OpinionSubjectsRepository $opinionSubjects,
        Request $request
    ) {
        return view('opinionSubjects.index')
            ->with('pesquisa', $request->get('pesquisa'))
            ->with('opinionSubjects', $opinionSubjects->search($request))
            ->with(
                'opinionSubjectsAttributes',
                $opinionSubjects->attributesShowing()
            )
            ->with(
                'opinionSubjectsEditAttribute',
                $opinionSubjects->editAttribute
            );
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function show($id)
    {
        $repository = app(OpinionSubjectsRepository::class);

        return view('opinionSubjects.form')
            ->with('formDisabled', true)
            ->with(['opinionSubject' => OpinionSubjectModel::find($id)])
            ->with(
                'opinionSubjectsFormAttributes',
                $repository->formAttributes()
            )
            ->with('root', $repository->getRoot());
    }

    public function jsonTree($selectedId = null)
    {
        $opinionSubjectsRepository = app(OpinionSubjectsRepository::class);

        $return = [$opinionSubjectsRepository->fullTree($selectedId)];

        return $return;
    }

    public function jsonArray()
    {
        $opinionSubjectsRepository = app(OpinionSubjectsRepository::class);

        $aux = $opinionSubjectsRepository->allOrderBy('id');

        $return = [];
        foreach ($aux as $item) {
            $return[$item->id] = $item;
        }

        return $return;
    }
}
