<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\NotFoundException;
use App\Facades\Responser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Facades\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{
    public function do_login(LoginRequest $request): UserResource
    {
        try {
            $user = User::by_email($request->input('email'));
            if (! $user) {
                throw new NotFoundException('Invalid email');
            }

            /**
             * Fetching user permission via their role
             */
            $permissions = $user->getPermissionsViaRoles()->map(function ($permission) {
                return $permission->name;
            })->toArray();

            $token = $user->createToken($request->validated('email'), $permissions);

            /**
             * Extracting needed data
             */
            $data = [
                'token' => $token->plainTextToken,
                'login_at' => $token->accessToken->created_at->format('Y-m-d h:i:s'),
                'email' => $request->validated('email'),
            ];

            /**
             * Storing data in user session history
             */
            $session_data = [
                'user_id' => $user->id,
                'token_name' => $request->validated('email'),
                'permissions' => collect($permissions)->implode(','),
                'roles' => $user->getRoleNames(),
                'platform' => null,
                'device_info' => null,
                'device_id' => null,
            ];
            $session_data = array_merge($session_data, $data);
            User::create_session_history($session_data);
            return new UserResource($user, 'User logged in', $token->plainTextToken, $data['login_at']);
        } catch (NotFoundException $exception) {
            return Responser::error($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function do_logout(Request $request): JsonResponse
    {
        User::do_logout($request->bearerToken());
        return Responser::ok('User logged out successfully', Response::HTTP_OK);
    }
}
