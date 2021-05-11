<?php


namespace App\Services;

use App\Repositories\AuthRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register($user)
    {
        try 
        {
            $result = $this->authRepository->register($user);
            return $result;
        }
        catch (\Throwable $th) 
        {
            return $th->getMessage();
        }
        
    }

    public function login($credentials)
    {
        if(!$token = auth()->attempt($credentials))
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout($token)
    {
        try 
        {
            JWTAuth::invalidate($token);
 
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function getAuthUser($token)
    {
        try 
        {
            $user = JWTAuth::authenticate($token);
            return response()->json(['user' => $user]);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    protected function respondWithToken($token)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60,
      ]);
    }
}