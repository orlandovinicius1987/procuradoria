<?php

namespace App\Data\Repositories;

use App\Data\Models\OpinionAuthor;

class OpinionAuthors extends Base
{

    public $editAttribute = 'name';

    /**
     * @var string
     */
    protected $model = OpinionAuthor::class;

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->makeResultForSelect($this->model::all(), 'name', 'id');
    }

    public function orderBy($query, $column, $order)
    {
        return $this->makeResultForSelect(
            $query->orderBy($column, $order)->get(), 'name', 'id'
        );
    }
}
