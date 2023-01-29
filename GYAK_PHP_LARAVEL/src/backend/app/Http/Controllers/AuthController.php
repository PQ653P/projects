<?php


namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Providers\AuthServiceProvider;
use App\Utils\StatusCode;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(LoginRequest $request): JsonResponse
    {
        $request->validated();
        $tokenResult = AuthServiceProvider::loginLogic($request->credentials(), $request->input('remember_me'));
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => $tokenResult->token->expires_at->toDateTimeString()
        ], StatusCode::ACCEPTED);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $request->validated();
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
        return response()->json([], StatusCode::CREATED);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();
        return response()->json([], StatusCode::ACCEPTED);
    }

    public function profile(): JsonResponse
    {
        return response()->json(Auth::user()->toArray());
    }
}
