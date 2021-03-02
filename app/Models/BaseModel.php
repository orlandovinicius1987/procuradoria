<?php

namespace App\Models;

use App\Data\Presenters\BasePresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\Facades\AutoPresenter;
use McCool\LaravelAutoPresenter\HasPresenter;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Venturecraft\Revisionable\RevisionableTrait;

abstract class BaseModel extends Model implements
    HasPresenter,
    AuditableContract
{
    use RevisionableTrait, AuditableTrait;
    use HasFactory;
    /**
     * @var bool
     */
    protected $revisionEnabled = true;

    /**
     * @var bool
     */
    protected $revisionCreationsEnabled = true;

    /**
     * @var array
     */
    protected $dataTypes = [];

    /**
     * @var array
     */
    protected $presenters = [];

    /**
     * @param $column
     *
     * @return mixed
     */
    public static function getDataTypeOf($column)
    {
        $model = new static();

        return collect($model->dataTypes)->get($column);
    }

    /**
     * @return string
     */
    public function getPresenterClass()
    {
        return BasePresenter::class;
    }

    /**
     * @return array
     */
    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();

        $decorated = AutoPresenter::decorate($this);

        foreach ($this->presenters as $key) {
            $attributes[$key] = $decorated->{$key};
        }

        return $attributes;
    }

    public function getModelAttribute()
    {
        return get_class($this);
    }
}
