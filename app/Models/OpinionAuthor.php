<?php

namespace App\Models;

class OpinionAuthor extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'opinion_authors';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    protected $appends = ['model'];

    /**
     * Get all of the author's opinions.
     */
    public function opinions()
    {
        return $this->morphMany(Opinion::class, 'authorable');
    }
}
