<?php 
namespace App\Services\ChangementJoueurMatchService;
  

use App\Repositories\ChangementRepository\ChangementRepositoryInterface;


class ChangementJoueurMatchService{

protected $Changement;

 public function __construct(ChangementRepositoryInterface $Changement)
 {
    $this->Changement=$Changement;
 }
    
 public function all(){
    return $this->Changement->all();
 }



}