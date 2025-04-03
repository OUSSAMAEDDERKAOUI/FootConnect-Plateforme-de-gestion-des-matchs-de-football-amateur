<?php 
// 
namespace App\Repositories\AdminLigueRepository;

use App\Models\AdminLigue;
use App\Models\Joueur;
use App\Models\Medecin;
use App\Models\Entraineur;
use App\Models\Arbitre;


class AdminLigueRepository
{
    protected $AdminLigue;

    public function __construct(AdminLigue $AdminLigue)
    {
        $this->AdminLigue = $AdminLigue;
    }

    // Vérifier si l'email est unique
    public function isEmailUnique($email)
    {
        return $this->AdminLigue->where('email', $email)->doesntExist();
    }

    // public function createAdminLigue(array $userData)
    // {
       
    
    //     $AdminLigue = AdminLigue::create([
    //         'Ligue_id'=>$userData['Ligue_id'],
    //         'telephone'=>$userData['telephone'],
    //         'email' => $userData['email'],
    //         'password' => $userData['password'],  
    //         'isBanned' => $userData['isBanned']?? false,
    //     ]);
    // // dump($AdminLigue);
    //     return $AdminLigue;

        
    
    // }
    

    public function findByCredentials(array $credentials)
    {
        return AdminLigue::where('email', $credentials['email'])->first();
    }
}
