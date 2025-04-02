<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class EmailTwoFactorAuthentication extends RedirectIfTwoFactorAuthenticatable
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  callable  $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        $user = $this->validateCredentials($request);

        if (optional($user)->two_factor_secret) {
            // Generate and send email code instead of using TOTP
            $user->generateAndSendTwoFactorCode();

            return $this->twoFactorChallengeResponse($request, $user);
        }

        return $next($request);
    }
}