<?php

namespace App\Data\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ActiveOpinion implements Scope
{
    /**
     * @param Builder $builder
     * @param Model   $model
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('is_active', '=', true);
    }
}
