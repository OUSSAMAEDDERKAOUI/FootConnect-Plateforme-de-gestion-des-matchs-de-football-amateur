<?php 
namespace App\Services\ChangementJoueurMatchService;
  

use App\Repositories\ChangementRepository\ChangementRepositoryInterface;


class ChangementJoueurMatchService{

protected $ChangementRepositoryInterface;

 public function __construct(ChangementRepositoryInterface $ChangementRepositoryInterface)
 {
    $this->ChangementRepositoryInterface=$ChangementRepositoryInterface;
 }




}