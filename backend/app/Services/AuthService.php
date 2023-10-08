<?php

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\IAuthService;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthService implements IAuthService
{
    protected User $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function login(array $credentials) : JsonResponse
    {
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function userAuth() : JsonResponse
    {
        return response()->json(auth()->user());
    }

    public function logout() : JsonResponse
    {
        try
        {
            if (auth()->check()) {
                auth()->logout();
            }
            return response()->json(['message' => 'Sessão finalizada com sucesso']);
        }
        catch(JWTException $e)
        {
            return response()->json(['message' => 'Erro: '.$e]);
        }

    }

    public function refresh() : JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken(string $token) : JsonResponse
    {
        $user = auth()->user();
        return response()->json([
            'user' => [
                'user_id' => $user['id']
            ],
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}