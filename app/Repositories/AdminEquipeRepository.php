<?php 
// 
namespace App\Repositories;

use App\Models\User;
use App\Models\Joueur;
use App\Models\Medecin;
use App\Models\Entraineur;
use App\Models\Arbitre;


class AdminEquipeRepository
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    // Vérifier si l'email est unique
    public function isEmailUnique($email)
    {
        return $this->userModel->where('email', $email)->doesntExist();
    }

    public function createAdminEquipe(array $userData)
    {
        if (isset($userData['photo'])) {
            $userData['photo'] = $userData['photo']->store('profil_photos', 'public');
        }
    
        $user = User::create([
          
            'email' => $userData['email'],
            'password' => $userData['password'],  
            'isBanned' => $userData['isBanned']?? false,

            'photo' => $userData['photo'] ?? null,
        ]);
    
    
        }
    
        return $user;
    }
    

    public function findByCredentials(array $credentials)
    {
        return User::where('email', $credentials['email'])->first();
    }
}
