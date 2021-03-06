<?php

namespace App\Data\Repositories;

use App\Models\TipoAndamento as TipoAndamento;

class TiposAndamentos extends Base
{
    /**
     * @var string
     */
    protected $model = TipoAndamento::class;

    /**
     * @return mixed
     */
    public function getAllIds()
    {
        return TipoAndamento::pluck('id');
    }
}
