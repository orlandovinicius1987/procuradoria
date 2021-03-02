<?php

namespace App\Models;

class SearchTerm extends BaseModel
{
    protected $connection = 'tribunais';

    protected $fillable = ['court', 'text'];
}
