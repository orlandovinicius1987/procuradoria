<?php

namespace App\Models;

class Meio extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'meios';

    /**
     * @var array
     */
    protected $fillable = ['nome'];
}
