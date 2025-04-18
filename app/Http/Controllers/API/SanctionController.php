<?php

namespace App\Http\Controllers\API;
use App\Models\Game;

use App\Models\User;
use App\Models\Sanction ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SanctionService\SanctionService;
use App\Http\Requests\Sanction\StoreSanctionRequest;
use App\Models\Joueur;

class SanctionController extends Controller
{

private $SanctionService;

public function __construct(SanctionService $SanctionService){

    $this->SanctionService=$SanctionService;
}







public function store(StoreSanctionRequest $request){

    $validatedData=$request->validated();
    $sanction =$this->SanctionService->ajouterSanction($validatedData);
    return response()->json([
        "status"=>"success",
        "message"=>'Sanction created successfully',
        "sanction"=>$sanction,
    ]);
}



public function update(Request $request , $SanctionId){

    $validatedData=$request->validate([
        'nbr_matchs'=>'required|integer', 
        'game_id'=>'required|integer', 
        'joueur_id'=>'required|integer', 

    ]);

    $sanction =$this->SanctionService->ajouterDureeSanction($validatedData , $SanctionId);

    return response()->json([
        "status"=>"success",
        "message"=>'Sanction updated successfully',
        "sanction"=>$sanction,
    ]);

}


public function destroy($SanctionId){
    $sanction =$this->SanctionService->deleteSanction($SanctionId);

    return response()->json([
        "status"=>"success",
        "message"=>'Sanction deleted successfully',
        "sanction"=>$sanction,
    ]);
}




public function getSanctionsById($sanctionId){

    $sanction = Sanction::with(['Joueur.user','Joueur.equipe','game.equipeExterieur','game.equipeDomicile'])
    ->whereRelation('Joueur', 'statut', '!=', 'blesse')
    ->orderBy('created_at','desc')
    ->where('id','=',$sanctionId)
    ->get();

    return response()->json([
        "status"=>"success",
        "message"=>' Sanction  By Id',
        "sanctions"=>$sanction,
    ]);
}





public function getALLSanctions(){

$sanctions = Sanction::with('Joueur.user')
    ->whereRelation('Joueur', 'statut', '!=', 'blesse')
    ->orderBy('created_at','desc')
    ->paginate(8);

return response()->json([
    "status"=>"success",
    "message"=>' All Sanction ',
    "sanctions"=>$sanctions,
]);


}



public function statistiques()
{
    return response()->json([
        'Suspension' => Sanction::where('statut', 'Suspension')->count(),
        'Carton_Jaune' => Sanction::whereIn('type', 'Carton Jaune')->count(),
        'Carton_Rouge' => Sanction::whereIn('type',  'Carton Rouge')->count(),
        'avertissements' => Sanction::where('type', 'Avertissement')->count(),
    ]);
}













}
