<?php

namespace App\Services\SanctionService;

use App\Repositories\SanctionRepository\SanctionRepository;

class SanctionService{

    private  $SanctionRepository;


    public function __construct(SanctionRepository $SanctionRepository){
        $this->SanctionRepository=$SanctionRepository;
    }


public function ajouterSanction(array $sanctionData){
    
   
    $sanction= $this->SanctionRepository->ajouterSanction($sanctionData);

    return $sanction;
}
public function ajouterDureeSanction(array $SanctionData , $SanctionId){
    
   
    $sanction= $this->SanctionRepository->ajouterDureeSanction($SanctionData , $SanctionId);
    
    return $sanction;
}

public function deleteSanction( $SanctionId){
    
   
    $sanction= $this->SanctionRepository->deleteSanction( $SanctionId);
    
    return $sanction;
}

}