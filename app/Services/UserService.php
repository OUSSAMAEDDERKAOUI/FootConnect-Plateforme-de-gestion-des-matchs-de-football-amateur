<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        if (Auth::guard('api')->attempt($credentials)) {

            $user = Auth::guard('api')->user();

            $token = Auth::guard('api')->login($user);

            return ['user' => $user, 'token' => $token];
        }

        return null;
    }
    public function logout()
    {
        Auth::guard('api')->logout();
    }
}

