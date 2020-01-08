<?php

namespace App\Http\Controllers\Api;

use App\Data\Repositories\ArmazenadosEm as ArmazenadosEmRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArmazenadosEm extends Controller
{
    public function select(Request $request)
    {
        return app(ArmazenadosEmRepository::class)->selectOptions();
    }
}
