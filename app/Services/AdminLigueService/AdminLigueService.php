<?php

namespace App\Services\AdminLigueService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\AdminLigueRepository\AdminLigueRepository;

class AdminLigueService
{
    protected $AdminLigueRepository;

    public function __construct(AdminLigueRepository $AdminLigueRepository)
    {
        $this->AdminLigueRepository = $AdminLigueRepository;
    }

    // public function RegisterAdminLigue(array $userData)
    // {
    //     if ($this->AdminLigueRepository->isEmailUnique($userData['email'])) {
            
    //         $userData['password'] = bcrypt($userData['password']);
            
    //         $user = $this->AdminLigueRepository->createAdminLigue($userData);


    //         return $user;
    //     }

    //     return null;
    // }
 


    public function authenticate(array $credentials)
    {

        if (Auth::guard('api_admin_ligue')->attempt($credentials)) {

            $user = Auth::guard('api_admin_ligue')->user();

            $token = Auth::guard('api_admin_ligue')->login($user);

            return ['user' => $user, 'token' => $token];
        }

        return null;
    }
    public function logout()
    {
        Auth::guard('api')->logout();
    }
}


