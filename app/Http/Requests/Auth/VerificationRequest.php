<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationRequest extends EmailVerificationRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = User::byAccountId($this->account_id)->first();

        if ($user->hasVerifiedEmail() || $user->verification_token_expiring_at < now() || ! hash_equals(
            $this->token,
            sha1($user->verification_token)
        )) {
            return false;
        }

        return hash_equals(
            (string) $this->hash,
            sha1($user->getEmailForVerification())
        );
    }

    /**
     * Fulfill the email verification request.
     *
     * @return void
     */
    public function fulfill()
    {
        $user = User::byAccountId($this->account_id)->first();

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            event(new Verified($user));
        }
    }
}
