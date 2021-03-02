<?php

namespace App\Data\Repositories;

use App\Models\Opinion;
use App\Models\OpinionAuthor;
use App\Models\User;
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
            'name' => 'authorable',
            'showName' => 'Procurador',
            'columnSize' => '10%',
            'type' => 'id',
            'relationName' => 'authorable',
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

    public function searchAttributes()
    {
        $array = [];
        $array[] = (object) [
            'name' => 'opinion_scope_id',
            'type' => 'id',
            'relationName' => 'opinionScope',
            'foreignName' => 'name',
        ];
        $array[] = (object) [
            'name' => 'authorable_id',
            'type' => 'morph',
            'relationName' => 'authorable',
            'foreignName' => 'name',
        ];
        $array[] = (object) [
            'name' => 'approve_option_id',
            'type' => 'id',
            'relationName' => 'approveOption',
            'foreignName' => 'name',
        ];
        $array[] = (object) [
            'name' => 'opinion_type_id',
            'type' => 'id',
            'relationName' => 'opinionType',
            'foreignName' => 'name',
        ];
        $array[] = (object) [
            'name' => 'suit_number',
            'type' => 'string',
        ];
        $array[] = (object) [
            'name' => 'suit_sheet',
            'type' => 'string',
        ];
        $array[] = (object) [
            'name' => 'identifier',
            'type' => 'string',
        ];
        $array[] = (object) [
            'name' => 'date',
            'type' => 'date',
        ];
        $array[] = (object) [
            'name' => 'party',
            'type' => 'string',
        ];
        $array[] = (object) [
            'name' => 'abstract',
            'type' => 'textarea',
        ];
        $array[] = (object) [
            'name' => 'opinion',
            'type' => 'textarea',
        ];
        $array[] = (object) [
            'name' => 'pdf_file',
            'type' => 'file',
        ];
        $array[] = (object) [
            'name' => 'doc_file',
            'type' => 'file',
        ];
        $array[] = (object) [
            'name' => 'is_active',
            'type' => 'boolean',
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

        $columns = $this->searchAttributes();

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
                    case 'morph':
                        $query->orWhereHasMorph($column->relationName, [User::class, OpinionAuthor::class], function (
                            $query, $type
                        ) use ($item, $column) {
                            $query->whereRaw(
                                'lower(' .
                                $column->foreignName .
                                ") like '%{$item}%'"
                            );
                        });
                        break;
                }
            }
        });

        return $query;
    }

    public function applySearchCheckboxes()
    {
    }

    public function getAllAuthors($opinionId = null)
    {
        if($opinionId) {
            $opinion = Opinion::withoutGlobalScopes()->find($opinionId);

            $authorable = $opinion->authorable;

            return app(OpinionAuthorsRepository::class)->all()->concat(app(UsersRepository::class)->getByType('Procurador'))->map(function ($item) use ($opinion, $authorable) {
                $collection = new Collection($item);
                $collection['selected'] = (($authorable->id == $item->id) && ($authorable->model == $item->model));
                return $collection;
            });
        }else{
            return app(OpinionAuthorsRepository::class)->all()->concat(app(UsersRepository::class)->getByType('Procurador'))->map(function ($item){
                $collection = new Collection($item);
                $collection['selected'] = false;
                return $collection;
            });
        }
    }
}
