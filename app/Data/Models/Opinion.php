<?php

namespace App\Data\Models;

use App\Data\Models\OpinionScope as OpinionScopeModel;
use App\Data\Models\OpinionType as OpinionTypeModel;
use App\Data\Models\User as UserModel;
use App\Data\Presenters\OpinionPresenter;
use App\Data\Scope\ActiveOpinion as ActiveOpinionScope;

class Opinion extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'opinions';

    protected $with = ['opinionScope', 'attorney', 'opinionType'];

    /**
     * @var array
     */
    protected $fillable = [
        'opinion_scope_id',
        'authorable_id',
        'authorable_type',
        'opinion_type_id',
        'suit_number',
        'suit_sheet',
        'identifier',
        'date',
        'party',
        'abstract',
        'opinion',
        'file_pdf',
        'file_doc',
        'created_by',
        'updated_by',
        'approve_option_id',
        'is_active'
    ];

    protected $presenters = [
        'formatted_date',
        'pdf_file_name',
        'doc_file_name'
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveOpinionScope());
    }

    public function opinionScope()
    {
        return $this->belongsTo(OpinionScopeModel::class);
    }

    public function attorney()
    {
        return $this->belongsTo(UserModel::class);
    }

    public function authorable()
    {
        return $this->morphTo();
    }

    public function opinionType()
    {
        return $this->belongsTo(OpinionTypeModel::class);
    }

    public function getPresenterClass()
    {
        return OpinionPresenter::class;
    }

    public function approveOption()
    {
        return $this->belongsTo(ApproveOption::class);
    }
}
