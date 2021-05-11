<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authServices;

    public function __construct(AuthService $authServices)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->authServices = $authServices;
    }

    public function register(UserRequest $request)
    {
        if($request->validator->fails())
        {
            return $request->validator->errors();
        }
        $user = [
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
        ];
        return $this->authServices->register($user);
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email'     =>  'required',
            'password'  =>  'required',
        ]);
        $credentials = $request->only(['email','password']);
        return $this->authServices->login($credentials);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        return $this->authServices->logout($request->token);
    }

    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        return $this->authServices->getAuthUser($request->token);
        
    }
}
