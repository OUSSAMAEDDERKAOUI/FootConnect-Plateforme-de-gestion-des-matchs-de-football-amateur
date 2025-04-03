<?php

namespace App\Services\AdminEquipeService;

use App\Repositories\AdminEquipeRepository\AdminEquipeRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminEquipeService
{
    protected $AdminEquipeRepository;

    public function __construct(AdminEquipeRepository $AdminEquipeRepository)
    {
        $this->AdminEquipeRepository = $AdminEquipeRepository;
    }

    public function RegisterAdminEquipe(array $userData)
    {
        if ($this->AdminEquipeRepository->isEmailUnique($userData['email'])) {
            
            $userData['password'] = bcrypt($userData['password']);
            
            $user = $this->AdminEquipeRepository->createAdminEquipe($userData);


            return $user;
        }

        return null;
    }
 


    public function authenticate(array $credentials)
    {

        if (Auth::guard('api_admin_equipe')->attempt($credentials)) {

            $user = Auth::guard('api_admin_equipe')->user();

            $token = Auth::guard('api_admin_equipe')->login($user);

            return ['user' => $user, 'token' => $token];
        }

        return null;
    }
    public function logout()
    {
        Auth::guard('api')->logout();
    }
}

