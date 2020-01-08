<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Data\Repositories\Users as UsersRepository;
use App\Http\Controllers\Controller;

class Users extends Controller
{
    public function selectAttorneyOptions(Request $request)
    {
        return app(UsersRepository::class)->selectAttorneyOptions();
    }

    public function selectInternOptions(Request $request)
    {
        return app(UsersRepository::class)->selectInternOptions();
    }

    public function selectAdvisorOptions(Request $request)
    {
        return app(UsersRepository::class)->selectAdvisorOptions();
    }
}
