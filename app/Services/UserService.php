<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(array $userData)
    {
        if ($this->userRepository->isEmailUnique($userData['email'])) {
            
            $userData['password'] = bcrypt($userData['password']);
            
            $user = $this->userRepository->createUser($userData);


            return $user;
        }

        return null;
    }
 


    public function authenticate(array $credentials)
    {




        $user = $this->userRepository->findByCredentials($credentials);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }
        
        if (!Hash::check($credentials["password"], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized Password',
            ], 401);
        }
        
        
            $token = JWTAuth::fromUser($user);
        






        if ($token) {

            return ['user' => $user, 'token' => $token];
        }

        return null;
    }
    public function logout()
    {
        Auth::guard('api')->logout();
    }
}

