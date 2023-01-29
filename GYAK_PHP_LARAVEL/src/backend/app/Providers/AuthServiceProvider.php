<?php

namespace App\Providers;

use App\Http\Requests\LoginRequest;
use App\Utils\StatusCode;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Laravel\Passport\PersonalAccessTokenResult;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensExpireIn(now()->addDays());
        Passport::refreshTokensExpireIn(now()->addDays(10));
        Passport::personalAccessTokensExpireIn(now()->addMonths());
    }

    public static function loginLogic(array $credentials, bool $remember_me = false): PersonalAccessTokenResult
    {
        if (!Auth::attempt($credentials))
            abort(StatusCode::UNAUTHORIZED);
        $tokenResult = Auth::user()->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($remember_me)
            $token->expires_at = Carbon::now()->addMonth();
        $token->save();
        return $tokenResult;
    }
}
