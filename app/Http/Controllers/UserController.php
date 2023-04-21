<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\{UserCreateRequest, UserLoginRequest};

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

        return response()->json(['token' => $token], 200);;
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

    
}
