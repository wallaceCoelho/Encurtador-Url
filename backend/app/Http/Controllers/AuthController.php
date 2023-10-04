<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IAuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected IAuthService $auth;

    public function __construct(IAuthService $auth) 
    {
        $this->auth = $auth;
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'data' => [
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]
        ]);
    }
}
