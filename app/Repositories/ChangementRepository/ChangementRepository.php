<?php 
namespace App\Repositories\ChangementRepository;

use App\Models\ChangementJoueurMatch;
use App\Models\Game;
use App\Models\Joueur;
use App\Models\Equipe;

class ChangementRepository implements ChangementRepositoryInterface{
    
   protected $model;
   public function __construct(ChangementJoueurMatch $model){
    $this->model=$model;
   }
    public function All(){

        

        return $this->model->all();

    }

    public function find($id){
        
    }

    public function update( $id ,array $data){
        
    }

    public function delete($id){
        
    }

    public function create(array $data){
        
    }

    
}

