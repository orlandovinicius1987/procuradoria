<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;

class Apenso extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['processo_id', 'apensado_id'];

    /**
     * @var array
     */
    protected $with = ['apensado', 'processo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function apensado()
    {
        return $this->belongsTo(Processo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function processo()
    {
        return $this->belongsTo(Processo::class);
    }

    /**
     * @param array $options
     *
     * @return bool|void
     */
    public function save(array $options = [])
    {
        Cache::forget('getProcessosData' . $this->processo_id);
        Cache::forget('getProcessosData' . $this->apensado_id);
        parent::save();
    }
}
