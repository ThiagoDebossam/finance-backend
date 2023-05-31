<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Http\Requests\{UserCreateRequest, UserLoginRequest, UserForgotPasswordRequest, UserRecoverPasswordRequest};
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;

class UserController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(UserCreateRequest $request)
    {
        $data = $request->all();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Login in system
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function login(UserLoginRequest $request)
    {
        $data = $request->all(['email', 'password']);

        $token = auth('api')->attempt($data);

        if (!$token) {
            return response()->json(['msg' => 'Usuário e/ou senha inválidos'], 403);
        }

        $user = auth('api')->user()->getAttributes();

        if ($user['remember_token'] && JWTAuth::setToken($user['remember_token'])->check()) {
            JWTAuth::setToken($user['remember_token'])->invalidate();
        }

        auth('api')->user()->setAttribute('remember_token', $token);
        auth('api')->user()->save();

        $data = auth('api')->user();
        $data['token'] = $token;

        return response()->json($data, 200);
    }

    /**
     * Update user
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function update(UserCreateRequest $request, $id)
    {
        $user = User::find($id);
        $user->fill($request->all());
        $user->password = Hash::make($user->password);
        $user->save();
        return $user;
    }

    public function me () {

        return response()->json(auth()->user());
    }

    public function logout () {
        $token = auth('api')->logout();
        return response()->json(['msg' => 'Logout realizado']);
    }

    public function refresh () {
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }

    public function forgotPassword (UserForgotPasswordRequest $request) {
        try {
            $user = User::where('email', $request->all(['email']))->first();
            if (empty($user) || !$user) self::emitException('Usuário não encontrado!');
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return response()->json(['msg' => true]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function recoverPassword (UserRecoverPasswordRequest $request) {
        try {
            JWTAuth::setToken($request['token']);
            return JWTAuth::parseToken()->getPayload();
            return response()->json(['msg' => true]);
        } catch (Exception $e) {
            throw $e;
        }
    }
    
}
