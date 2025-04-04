<?php 

namespace App\Repositories\SanctionRepository;
use App\Models\Sanction;


class SanctionRepository{

private $SanctionModel ;
 

public function __construct(Sanction $SanctionModel){
    $this->SanctionModel=$SanctionModel;

}
   

public function ajouterSanction(array $SanctionData ){


    $sanction = Sanction::create($SanctionData);
    return $sanction;

}

public function ajouterDureeSanction(array $SanctionData , $SanctionId){

    $sanction=Sanction::findOrFail($SanctionId);

    $sanction->update($SanctionData);
    return $sanction;

}
public function deleteSanction( $SanctionId){

    $sanction=Sanction::findOrFail($SanctionId);

    $sanction->delete();
    return $sanction;

}


}