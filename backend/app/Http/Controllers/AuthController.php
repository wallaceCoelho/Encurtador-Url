<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected IAuthService $auth;

    public function __construct(IAuthService $auth) 
    {
        $this->auth = $auth;
    }

    public function login(Request $request) : JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        return $this->auth->login($credentials);
    }
    
}
