<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller
{
    /**
     * User authorization
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        try {
            $user = User::where('email', $validated['email'])->first();

            if (!Hash::check($validated['password'], $user['password'])) {
                return response(['message' => 'Пароли не совпадают'], 405);
            }
        } catch (Throwable $e) {
            return response(['message' => 'Пользователя с таким Email нет'], 403);
        }

        $token = $user->createToken('api')->plainTextToken;
        return response(['token' => $token, 'user' => new UserResource($user)], 200);
    }


    /**
     * User authorization
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function me(Request $request)
    {
        $user = $request->user();

        return new UserResource($user);
    }

    /**
     * User logout
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response(['message' => 'Пользователь вышел из учетной записи'], 200);
    }
}
