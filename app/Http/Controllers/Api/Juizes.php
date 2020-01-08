<?php

namespace App\Http\Controllers\Api;

use App\Data\Repositories\Juizes as JuizesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Juizes extends Controller
{
    public function select(Request $request)
    {
        return app(JuizesRepository::class)->selectOptions();
    }
}
