<?php
namespace App\Http\Controllers\API;
use App\Models\Equipe;

use App\Models\Joueur;
use App\Models\AdminEquipe;
use App\Mail\TeamStatusUpdated;
use App\Http\Controllers\Controller;
use App\Jobs\SendStatutEquipeBymail;
use Illuminate\Support\Facades\Mail;
use App\Services\EquipeService\EquipeService;
use App\Http\Requests\EquipeRequest\StoreEquipeRequest;
use App\Models\Medecin;
use Illuminate\Support\Facades\Auth;

class EquipeController extends Controller
{
    protected $equipeService;

    public function __construct(EquipeService $equipeService)
    {
        $this->equipeService = $equipeService;
    }

    public function index()
    {
        $equipes = $this->equipeService->getAllEquipes();
        return response()->json($equipes);
    }

    public function store(StoreEquipeRequest $request)
    {
        $data = $request->validated();
        $equipe = $this->equipeService->createEquipe($data);
        return response()->json($equipe, 201);
    }

    public function show($id)
    {
        $equipe = $this->equipeService->getEquipeById($id);
        if (!$equipe) {
            return response()->json(['message' => 'equipes not found'], 404);
        }
        return response()->json($equipe);
    }

    public function update(StoreEquipeRequest $request, $id)
    {
        $data = $request->validated();
        $equipe = $this->equipeService->updateEquipe($id, $data);
        return response()->json($equipe);
    }

    public function destroy($id)
    {
        $this->equipeService->deleteEquipe($id);
        return response()->json(['message' => 'Equipe deleted successfully']);
    }


    public function makeListTraité($id){


        $equipe = Equipe::findOrFail($id);

        // Traité
        $equipe->statut= "Traité"; 
        $equipe->save();

    
        
        // dump($admin->email);
        SendStatutEquipeBymail::dispatch($equipe);

    
        
        return response()->json([
            'message' => 'La liste des joueur a été Traité avec succès.',
            'equipe' => $equipe
        ], 200);

    }


    public function getList(){
        $list=Equipe::with(["joueurs.user"])->paginate(8);
        $equipes=Equipe::withCount('joueurs')->orderBy('equipes.nom')->paginate(8);
        return response()->json([
            "equipes"=>$equipes,
            'list'=>$list,
       ] );
    }
    public function getPlayersList($id){
        $list=Equipe::with(["joueurs.user"])->where("id",$id)->paginate(8);
        return response()->json([
            'list'=>$list,
       ] );
    }
    public function getPlayersTeam($id)
{
    $equipe = Equipe::findOrFail($id);
    
    $joueurs = Joueur::with('user')
        ->where('equipe_id', $equipe->id)
        ->paginate(6); 

    return response()->json([
        'equipe' => $equipe,
        'list' => $joueurs,
    ]);
}

public function getequipeIdbyMedecin()
{
    $user = Auth()->user();
$userId=$user->id;
    $medecin=Medecin::where("user_id",$userId)->first();

    if (!$user) {
        return response()->json([
            'message' => 'Aucun utilisateur .'
        ], 404);
    }

    return response()->json([
        'medecin' => $medecin,
    ]);
}


}

