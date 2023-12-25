<?php

namespace App\Providers;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as JsonResponse;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('successMessage', function ($message = null, $status = JsonResponse::HTTP_OK): JsonResponse {
            return Response::json([
                'message' => $message ?? __('responses.general.success'),
            ], $status);
        });

        Response::macro('success', function ($data, $status = JsonResponse::HTTP_OK): JsonResponse {
            return Response::json(['data' => $data], $status);
        });

        Response::macro('errorMessage', function ($message = null, $status = JsonResponse::HTTP_BAD_REQUEST): JsonResponse {
            return Response::json([
                'message' => $message ?? __('responses.general.error'),
            ], $status);
        });

        Response::macro('error', function ($data, $status = JsonResponse::HTTP_BAD_REQUEST): JsonResponse {
            return Response::json(['data' => $data], $status);
        });

        Response::macro('token', function ($user, $abilities = ['*']): JsonResponse {
            return Response::success(
                [
                    'token' => $user->createToken($user->email, $abilities)->plainTextToken,
                    'user' => new UserResource($user),
                ],
            );
        });
    }
}
