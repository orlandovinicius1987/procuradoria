<?php

namespace App\Data\Repositories;

use App\Models\Tag;

class Tags extends Base
{
    /**
     * @var string
     */
    protected $model = Tag::class;

    public function selectOptions()
    {
        return $this->model::pluck('name', 'id');
    }
}
