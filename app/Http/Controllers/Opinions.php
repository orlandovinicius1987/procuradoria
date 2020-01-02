<?php

namespace App\Http\Controllers;

use App\Data\Models\ApproveOption;
use App\Data\Models\Opinion as OpinionModel;
use App\Data\Models\OpinionsSubject;
use App\Data\Models\User;
use App\Data\Repositories\ApproveOptions as ApproveOptionsRepository;
use App\Data\Repositories\Opinions as OpinionsRepository;
use App\Data\Repositories\OpinionScopes as OpinionScopesRepository;
use App\Data\Repositories\OpinionsSubjects as OpinionsSubjectsRepository;
use App\Data\Repositories\OpinionSubjects as OpinionSubjectsRepository;
use App\Data\Repositories\OpinionTypes as OpinionTypesRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Http\Requests\OpinionStore as OpinionStoreRequest;
use App\Http\Requests\OpinionUpdate as OpinionUpdateRequest;
use App\Http\Requests\OpinionsSubject as OpinionsSubjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Opinions extends Controller
{
    protected $checkboxes = ['show-inactive'];

    /**
     * @var OpinionsRepository
     */
    private $repository;

    /**
     * Opinions constructor.
     *
     * @param OpinionsRepository $repository
     */
    public function __construct(OpinionsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return $this
     */
    public function create()
    {
        return view('opinions.form')
            ->with(['opinion' => $this->repository->new()])
            ->with('formDisabled', false)
            ->with('mode', 'create')
            ->with($this->getOpinionsData());
    }

    /**
     * @param OpinionStoreRequest     $request
     * @param OpinionsRepository $repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(
        OpinionStoreRequest $request,
        OpinionsRepository $repository
    ) {
        foreach ($request->allFiles() as $key => $file) {
            $extension = $file->getClientOriginalExtension();

            $base64Content = base64_encode(
                file_get_contents($file->getPathName())
            );

            $request->merge(['file_' . $extension => $base64Content]);
        }

        $data = $request->all();

        if(is_null($request['id'])) {
            $data['created_by'] = Auth::user()->id;
        }
        $data['updated_by'] = Auth::user()->id;

        $newOpinion = $repository->createFromRequest($data);

        return redirect()
            ->route('opinions.show', ['id' => $newOpinion->id])
            ->with('formDisabled', false)
            ->with(
                $this->getSuccessMessage(
                    'Gravado com sucesso. Insira os assuntos correspondentes.'
                )
            );
    }

    /**
     * @param OpinionUpdateRequest     $request
     * @param OpinionsRepository $repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(
        OpinionUpdateRequest $request,
        OpinionsRepository $repository
    ) {
        return $this->store($request, $repository);
    }

    public function download($id, $fileExtension)
    {
        $mime = '';
        $attributeName = '';
        $currentOpinion = OpinionModel::withoutGlobalScopes()->find($id);

        if ($fileExtension == 'pdf') {
            $mime = 'application/pdf';
            $attributeName = 'file_pdf';
        } elseif ($fileExtension == 'doc') {
            $mime = 'application/msword';
            $attributeName = 'file_doc';
        }

        $fileName =
            'Parecer' .
            ' - ' .
            $currentOpinion->authorable->name .
            ' - ' .
            $currentOpinion->date .
            ' - ' .
            $currentOpinion->id .
            '.' .
            $fileExtension;

        $response = response(
            base64_decode($currentOpinion->$attributeName),
            200,
            [
                'Content-Type' => $mime,
                'Content-Disposition' =>
                    'attachment; filename="' . $fileName . '"',
            ]
        );

        return $response;
    }

    /**
     * @param OpinionsRepository $opinions
     * @param Request            $request
     *
     * @return $this|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        return view('opinions.index')
            ->with('pesquisa', $request->get('pesquisa'))
            ->with('checkboxValues', $this->getCheckboxValues($request))
            ->with('opinions', $this->repository->search($request))
            ->with('isProcurador', $user->is_procurador)
            ->with('opinionsAttributes', $this->repository->attributesShowing())
            ->with('opinionEditAttribute', $this->repository->editAttribute);
    }

    public function getCheckboxValues($request)
    {
        $array = [];

        collect($this->checkboxes)->each(function ($checkbox) use (
            &$array,
            $request
        ) {
            if ($request->has($checkbox)) {
                $array[$checkbox] = !!$request->get($checkbox);
            }
        });

        return $array;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function show($id)
    {
        $opinionSubjectsRepository = app(OpinionSubjectsRepository::class);

        return view('opinions.form')
            ->with('formDisabled', true)
            ->with([
                'opinion' => OpinionModel::withoutGlobalScopes()->find($id),
            ])
            ->with('opinionSubjectsAttributes', $opinionSubjectsRepository->attributesShowing())
            ->with('opinionSubjectsEditAttribute', $opinionSubjectsRepository->editAttribute)
            ->with('mode', 'update')
            ->with($this->getOpinionsData($id));
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function relacionarAssunto(
        OpinionsSubjectRequest $request,
        OpinionsSubjectsRepository $repository,
        $opinion_id
    ) {
        $repository->createFromRequest($request);

        return redirect()
            ->route('opinions.show', $request->opinion_id)
            ->with($this->getSuccessMessage());
    }

    public function getSelectedAuthorableKey($allAuthors)
    {
        $returnKey = null;

        $allAuthors->each(function ($item, $key) use (&$returnKey){
            if($item['selected']) $returnKey = $key;
        });

        return $returnKey;
    }

    public function getOpinionsData($id = null)
    {
        if ($id == null) {
            $opinionSubjects = app(
                OpinionSubjectsRepository::class
            )->allOrderBy('name');
        } else {
            $query = OpinionsSubject::where('opinion_id', $id)->get();
            $opinionSubjects = [];
            foreach ($query as $item) {
                $opinionSubjects[] = $item->subject;
            }
        }

        $allAuthors = app(OpinionsRepository::class)
            ->getAllAuthors($id);

        $selectedAuthorableKey = $this->getSelectedAuthorableKey($allAuthors);

        return [
            'opinionTypes' => app(OpinionTypesRepository::class)
                ->allOrderBy('name')
                ->toArray(),
            'opinionScopes' => app(OpinionScopesRepository::class)
                ->allOrderBy('name')->toArray(),
            'authorables' => $allAuthors->toArray(),
            'selectedAuthorableKey' => $selectedAuthorableKey,
            'opinionSubjects' => $opinionSubjects,
            'allOpinionSubjects' => app(
                OpinionSubjectsRepository::class
            )->allOrderBy('name'),
            'approveOptions' => app(ApproveOptionsRepository::class)
                ->allOrderBy('name')
                ->toArray(),
        ];
    }
}
