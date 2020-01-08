<?php

namespace App\Http\Controllers\Api;

use App\Data\Repositories\TiposAndamentos as TiposAndamentosRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TiposAndamentos extends Controller
{
    public function select(Request $request)
    {
        return app(TiposAndamentosRepository::class)->selectOptions();
    }
}
