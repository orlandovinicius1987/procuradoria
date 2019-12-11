<?php

namespace App\Data\Repositories;

use App\Data\Models\Opinion;
use App\Data\Models\OpinionAuthor;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\OpinionAuthors as OpinionAuthorsRepository;
use App\Data\Scope\ActiveOpinion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Opinions extends Base
{
    public function attributesShowing()
    {
        $array = [];

        $array[] = (object) [
            'name' => 'identifier',
            'showName' => 'Identificador',
            'columnSize' => '10%',
            'type' => 'string',
        ];

        $array[] = (object) [
            'name' => 'opinion_scope',
            'showName' => 'Abrangência',
            'columnSize' => '10%',
            'type' => 'id',
            'relationName' => 'opinionScope',
            'foreignName' => 'name',
        ];

        $array[] = (object) [
            'name' => 'attorney',
            'showName' => 'Procurador',
            'columnSize' => '10%',
            'type' => 'id',
            'relationName' => 'attorney',
            'foreignName' => 'name',
        ];

        $array[] = (object) [
            'name' => 'opinion_type',
            'showName' => 'Tipo',
            'columnSize' => '10%',
            'type' => 'id',
            'relationName' => 'opinionType',
            'foreignName' => 'name',
        ];

        $array[] = (object) [
            'name' => 'formatted_date',
            'showName' => 'Data',
            'columnSize' => '10%',
            'type' => 'date',
        ];

        $array[] = (object) [
            'name' => 'abstract',
            'showName' => 'Ementa',
            'columnSize' => '50%',
            'type' => 'string',
        ];

        return $array;
    }

    public function createFormAttributes()
    {
        $array = [];

        $array[] = (object) [
            'name' => 'opinion_scope_id',
            'showName' => 'Abrangência',
            'type' => 'id',
            'modelName' => 'opinionScope',
            'attributeArray' => 'opinionScopes',
            'relationName' => 'opinionScope',
            'foreignName' => 'name',
        ];

        $array[] = (object) [
            'name' => 'approve_option_id',
            'showName' => 'Aprovado',
            'type' => 'id',
            'modelName' => 'ApproveOption',
            'attributeArray' => 'approveOptions',
            'relationName' => 'approveOption',
            'foreignName' => 'name',
        ];

        $array[] = (object) [
            'name' => 'opinion_type_id',
            'showName' => 'Tipo',
            'type' => 'id',
            'modelName' => 'opinionType',
            'attributeArray' => 'opinionTypes',
            'relationName' => 'opinionType',
            'foreignName' => 'name',
        ];
        $array[] = (object) [
            'name' => 'suit_number',
            'showName' => 'Número do Processo',
            'type' => 'string',
        ];
        $array[] = (object) [
            'name' => 'suit_sheet',
            'showName' => 'Folha do Processo',
            'type' => 'string',
        ];
        $array[] = (object) [
            'name' => 'identifier',
            'showName' => 'Identificador',
            'type' => 'string',
        ];
        $array[] = (object) [
            'name' => 'date',
            'showName' => 'Data',
            'type' => 'date',
        ];

        $array[] = (object) [
            'name' => 'party',
            'showName' => 'Interessado',
            'type' => 'string',
        ];
        $array[] = (object) [
            'name' => 'abstract',
            'showName' => 'Ementa',
            'type' => 'textarea',
        ];
        $array[] = (object) [
            'name' => 'opinion',
            'showName' => 'Parecer',
            'type' => 'textarea',
        ];

        $array[] = (object) [
            'name' => 'pdf_file',
            'showName' => 'Arquivo .pdf',
            'type' => 'file',
        ];

        $array[] = (object) [
            'name' => 'doc_file',
            'showName' => 'Arquivo .doc',
            'type' => 'file',
        ];

        $array[] = (object) [
            'name' => 'is_active',
            'showName' => 'Ativo',
            'type' => 'boolean',
            'default' => true,
        ];

        return $array;
    }

    public function showFormAttributes($isProcurador)
    {
        $array = [];

        $array[] = (object) [
            'name' => 'opinion_scope_id',
            'showName' => 'Abrangência',
            'type' => 'id',
            'modelName' => 'opinionScope',
            'attributeArray' => 'opinionScopes',
            'relationName' => 'opinionScope',
            'foreignName' => 'name',
            'visible' => true,
        ];

        $array[] = (object) [
            'name' => 'approve_option_id',
            'showName' => 'Aprovado',
            'type' => 'id',
            'modelName' => 'ApproveOption',
            'attributeArray' => 'approveOptions',
            'relationName' => 'approveOption',
            'foreignName' => 'name',
            'visible' => true,
        ];

        $array[] = (object) [
            'name' => 'opinion_type_id',
            'showName' => 'Tipo',
            'type' => 'id',
            'modelName' => 'opinionType',
            'attributeArray' => 'opinionTypes',
            'relationName' => 'opinionType',
            'foreignName' => 'name',
            'visible' => true,
        ];
        $array[] = (object) [
            'name' => 'suit_number',
            'showName' => 'Número do Processo',
            'type' => 'string',
            'visible' => true,
        ];
        $array[] = (object) [
            'name' => 'suit_sheet',
            'showName' => 'Folha do Processo',
            'type' => 'string',
            'visible' => true,
        ];
        $array[] = (object) [
            'name' => 'identifier',
            'showName' => 'Identificador',
            'type' => 'string',
            'visible' => true,
        ];
        $array[] = (object) [
            'name' => 'date',
            'showName' => 'Data',
            'type' => 'date',
            'visible' => true,
        ];
        $array[] = (object) [
            'name' => 'party',
            'showName' => 'Interessado',
            'type' => 'string',
            'visible' => true,
        ];
        $array[] = (object) [
            'name' => 'abstract',
            'showName' => 'Ementa',
            'type' => 'textarea',
            'visible' => true,
        ];
        $array[] = (object) [
            'name' => 'opinion',
            'showName' => 'Parecer',
            'type' => 'textarea',
            'visible' => true,
        ];
        $array[] = (object) [
            'name' => 'pdf_file_name',
            'showName' => 'PDF',
            'linkName' => 'Visualizar',
            'type' => 'link',
            'visible' => true,
            'extension' => 'pdf',
        ];
        $array[] = (object) [
            'name' => 'doc_file_name',
            'showName' => 'DOC',
            'linkName' => 'Visualizar',
            'type' => 'link',
            'visible' => true,
            'extension' => 'doc',
        ];

        $array[] = (object) [
            'name' => 'pdf_file',
            'showName' => 'Arquivo .pdf',
            'type' => 'file',
            'visible' => true,
            'extension' => 'pdf',
        ];

        $array[] = (object) [
            'name' => 'doc_file',
            'showName' => 'Arquivo .doc',
            'type' => 'file',
            'visible' => true,
            'extension' => 'doc',
        ];

        $array[] = (object) [
            'name' => 'is_active',
            'showName' => 'Ativo',
            'type' => 'boolean',
            'visible' => true,
            'default' => true,
        ];

        return $array;
    }

    public $editAttribute = 'id';

    /**
     * @var string
     */
    protected $model = Opinion::class;

    /**
     * @param Request $request
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function search(Request $request)
    {
        $query = $this->model::query();
        $query = $this->applyCheckBoxes($query, $request);
        $query = $this->searchFromRequest($query, $request->get('pesquisa'));
        return $this->orderBy($query, 'updated_at', 'desc');
    }

    public function applyCheckBoxes(Builder $query, Request $request)
    {
        if ($request->has('show-inactive')) {
            if ($request->get('show-inactive')) {
                $query->withoutGlobalScope(ActiveOpinion::class);
            }
        }

        return $query;
    }

    /**
     * @param null|string $search
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function searchFromRequest($query, $search = null)
    {
        $search = is_null($search)
            ? collect()
            : collect(explode(' ', $search))->map(function ($item) {
                return strtolower($item);
            });

        $columns = $this->createFormAttributes();

        $search->each(function ($item) use ($columns, $query) {
            foreach ($columns as $column) {
                switch ($column->type) {
                    case 'string':
                        $query->orWhere(
                            DB::raw("lower({$column->name})"),
                            'like',
                            '%' . $item . '%'
                        );
                        break;
                    case 'textarea':
                        $query->orWhere(
                            DB::raw("lower({$column->name})"),
                            'like',
                            '%' . $item . '%'
                        );
                        break;
                    case 'id':
                        $query->orWhereHas($column->relationName, function (
                            $query
                        ) use ($item, $column) {
                            $query->whereRaw(
                                'lower(' .
                                    $column->foreignName .
                                    ") like '%{$item}%'"
                            );
                        });
                        break;
                    case 'date':
                        $ifdate = $this->toDate($item);
                        if ($ifdate != null) {
                            $query->orWhereDate($column->name, '=', $ifdate);
                        }
                        break;
                }
            }
        });

        return $query;
    }

    public function applySearchCheckboxes()
    {
    }

    public function getAllAuthors($opinionId)
    {
        $opinion = Opinion::find($opinionId);

        $authorable = $opinion->authorable;

        return app(OpinionAuthorsRepository::class)->all()->concat(app(UsersRepository::class)->getByType('Procurador'))->map(function ($item) use ($opinion, $authorable) {
            $collection = new Collection($item);
            $collection['selected'] = (($authorable->id == $item->id)&&($authorable->model == $item->model));
            return $collection;
        });
    }
}
