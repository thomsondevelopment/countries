<?php

namespace App\Http\Controllers\API;

use App\Actions\CreateUserAction;
use App\Actions\LoginUserAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request) {

        return CreateUserAction::run($request);
    }

    public function login(Request $request) {

        return LoginUserAction::run($request);

    }
}
