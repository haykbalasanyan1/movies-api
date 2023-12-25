<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;
use Spatie\Newsletter\Facades\Newsletter;

class RegistrationController extends Controller
{
    /**
     * @throws Exception
     */
    public function register(RegistrationRequest $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => strtolower($request->get('email')),
            'password' => Hash::make($request->get('password')),
        ]);

        event(new Registered($user));

        return response()->token($user);
    }
}
