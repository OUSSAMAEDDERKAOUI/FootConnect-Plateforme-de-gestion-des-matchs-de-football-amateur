<?php 
// 
namespace App\Repositories;

use App\Models\User;
use App\Models\Joueur;
use App\Models\Medecin;
use App\Models\Entraineur;
use App\Models\Arbitre;


class UserRepository
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

    public function createUser(array $userData)
    {
        if (isset($userData['photo'])) {
            $userData['photo'] = $userData['photo']->store('profil_photos', 'public');
        }
    
        $user = User::create([
            'prenom' => $userData['prenom'],
            'nom' => $userData['nom'],
            'nationalite' => $userData['nationalite'],
            'date_naissance' => $userData['date_naissance'],
            'telephone' => $userData['telephone'],
            'email' => $userData['email'],
            'password' => $userData['password'],  
            'isBanned' => $userData['isBanned']?? false,

            'role' => $userData['role'],
            'photo' => $userData['photo'] ?? null,
        ]);
    
        switch ($user->role) {
            case 'joueur':
                Joueur::create([
                    'equipe_id' => $userData['equipe_id'],
                    'numeroMaillot' => $userData['numeroMaillot'],
                    'position' => $userData['position'],
                    'statut' => $userData['statut'],
                    'user_id' => $user->id,
                ]);
                break;
    
            case 'arbitre':
                Arbitre::create([
                    'numero_accreditation' => $userData['numero_accreditation'],
                    'niveau' => $userData['niveau'],
                    'poste' => $userData['poste'],
                    'experience' => $userData['experience'],
                    'user_id' => $user->id,
                ]);
                break;
    
            case 'entraineur':
                Entraineur::create([
                    'experience' => $userData['experience'],
                    'licence' => $userData['licence'],
                    'role_entraineur' => $userData['role_entraineur'],
                    'statut' => $userData['statut'],
                    'user_id' => $user->id,
                ]);
                break;
    
            case 'medecin':
                Medecin::create([
                    'licence' => $userData['licence'],
                    'specialite' => $userData['specialite'],
                    'statut' => $userData['statut'],
                    'user_id' => $user->id,
                ]);
                break;
        }
    
        return $user;
    }
    

    public function findByCredentials(array $credentials)
    {
        return User::where('email', $credentials['email'])->first();
    }
}
