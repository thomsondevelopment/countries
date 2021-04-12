<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Actions\LoginUserAction;
use App\Actions\CreateUserAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {

        return CreateUserAction::run($request);
    }

    public function login(Request $request) {

        return LoginUserAction::run($request);

    }

    public function logout(Request $request) {
            $request->user()->tokens()->delete();

            return response()->json(null, 200);
    }
}
