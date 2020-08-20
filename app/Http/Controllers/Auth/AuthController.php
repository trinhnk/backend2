<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        
        if(!$token = JWTAuth::attempt($request->only(['email', 'password'])))
        {
            return abort(401);
        }
        return (new UserResource($user))
        ->additional([
           'meta' => [
                'token' => $token
            ]
        ]);
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if(!$token = JWTAuth::attempt($request->only(['email', 'password'])))
        {
            return response()->json([
                'errors' => [
                    'email' => ['Không tìm thấy tài khoản của bạn']
            ]], 422);
        }

        return (new UserResource($request->user()))
        ->additional([
            'meta' => [
                'token' => $token
            ]
        ]);
    }

    // public function user(Request $request) {
    //     return new UserResource($request->user());
    // }
    public function user() {
        return [
            'data' => JWTAuth::parseToken()->authenticate()
        ];
    }

    public function logout() {
        auth()->logout();
    }
}
