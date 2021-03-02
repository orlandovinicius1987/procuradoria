<?php

namespace App\Data\Repositories;

use App\Models\TipoProcesso;

class ArmazenadosEm extends Base
{
    public function all()
    {
        return '[{"id":"Não Armazenado","value":"Não Armazenado","text":"Não Armazenado"},{"id":"One Drive","value":"One Drive","text":"One Drive"}]';
    }

    public function selectOptions()
    {
        return $this->formatToSelect2(
            collect(json_decode($this->all()))->pluck('text', 'value')
        );
    }
}
