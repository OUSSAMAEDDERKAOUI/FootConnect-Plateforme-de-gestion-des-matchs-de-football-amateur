<?php 
// 
namespace App\Repositories;

use App\Models\AdminEquipe;
use App\Models\Joueur;
use App\Models\Medecin;
use App\Models\Entraineur;
use App\Models\Arbitre;


class AdminEquipeRepository
{
    protected $AdminEquipe;

    public function __construct(AdminEquipe $AdminEquipe)
    {
        $this->AdminEquipe = $AdminEquipe;
    }

    // Vérifier si l'email est unique
    public function isEmailUnique($email)
    {
        return $this->AdminEquipe->where('email', $email)->doesntExist();
    }

    public function createAdminEquipe(array $userData)
    {
       
    
        $AdminEquipe = AdminEquipe::create([
            'equipe_id'=>$userData['equipe_id'],
            'telephone'=>$userData['telephone'],
            'email' => $userData['email'],
            'password' => $userData['password'],  
            'isBanned' => $userData['isBanned']?? false,
        ]);
    // dump($AdminEquipe);
        return $AdminEquipe;

        
    
    }
    

    public function findByCredentials(array $credentials)
    {
        return AdminEquipe::where('email', $credentials['email'])->first();
    }
}
