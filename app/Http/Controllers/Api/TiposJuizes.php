<?php

namespace App\Http\Controllers\Api;

use App\Data\Repositories\TiposJuizes as TiposJuizesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TiposJuizes extends Controller
{
    public function select(Request $request)
    {
        return app(TiposJuizesRepository::class)->selectOptions();
    }
}
