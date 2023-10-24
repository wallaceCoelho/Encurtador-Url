<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected IUserService $userService;

    public function __construct(IUserService $userService) {
        $this->userService = $userService;
    }
    public function register(Request $request) : JsonResponse
    {
        $data = $request->only(['name', 'email', 'password', 'nickname', 'active']);
        return response()->json($this->userService->register($data));
    }
}
