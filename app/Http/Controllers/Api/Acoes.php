<?php

namespace App\Http\Controllers\Api;

use App\Data\Repositories\Acoes as AcoesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Acoes extends Controller
{
    public function select(Request $request)
    {
        return app(AcoesRepository::class)->selectOptions();
    }
}
