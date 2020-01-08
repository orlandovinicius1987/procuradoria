<?php

namespace App\Http\Controllers\Api;

use App\Data\Repositories\Tribunais as TribunaisRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Tribunais extends Controller
{
    public function select(Request $request)
    {
        return app(TribunaisRepository::class)->selectOptions();
    }
}
