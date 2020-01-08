<?php

namespace App\Http\Controllers\Api;

use App\Data\Repositories\Meios as MeiosRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Meios extends Controller
{
    public function select(Request $request)
    {
        return app(MeiosRepository::class)->selectOptions();
    }
}
