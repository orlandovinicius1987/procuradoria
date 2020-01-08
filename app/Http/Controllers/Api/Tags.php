<?php

namespace App\Http\Controllers\Api;

use App\Data\Repositories\Tags as TagsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Tags extends Controller
{
    public function select(Request $request)
    {
        return app(TagsRepository::class)->selectOptions();
    }
}
