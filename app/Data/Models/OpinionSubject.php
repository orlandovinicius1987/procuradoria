<?php

namespace App\Data\Models;

use App\Data\Presenters\OpinionSubjectPresenter;
use Kalnoy\Nestedset\NodeTrait;

class OpinionSubject extends BaseModel
{
    use NodeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'opinion_subjects';

    /**
     * @var array
     */
    protected $fillable = ['name', 'parent_id'];

    protected $presenters = [
        'edit_link',
        'full_name',
        'level',
        'indented_name',
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        $current = $this;
        $ancestors = $current
            ->ancestors()
            ->orderBy('_lft')
            ->get();

        $fullName = '';

        foreach ($ancestors as $key => $ancestor) {
            if ($key != 0) {
                $fullName .= $ancestor->name;
                $fullName .= ' - ';
            }
        }

        $fullName .= $current->name;

        return $fullName;
    }

    public function getPresenterClass()
    {
        return OpinionSubjectPresenter::class;
    }
}
