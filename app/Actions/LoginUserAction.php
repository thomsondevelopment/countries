<?php 

namespace App\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserAction {
    

    public static function run(Request $request) {
        $attributes = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);

        if (!Auth::attempt($attributes)) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Credentials not match',
            ], 401);
        }

        return response()->json([
            'user' => auth()->user()->only('id', 'name', 'email'),
            'token' => auth()->user()->createToken('x-access-token')->plainTextToken
        ]);
    }


}