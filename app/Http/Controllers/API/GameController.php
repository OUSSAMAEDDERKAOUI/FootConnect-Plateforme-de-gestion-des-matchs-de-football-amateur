<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use App\Services\GameService\GameService;
use App\Http\Requests\Games\StoreGameRequest;
use App\Http\Requests\Games\UpdateGameRequest;
use App\Http\Requests\Games\ProgrammerGameRequest;
use App\Models\Arbitre;

class GameController extends Controller
{

     private $GameService;

public function __construct(GameService $GameService)
{
    $this->GameService =$GameService;
}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matchs = $this->GameService->allScheduledMatches();
        return response()->json([
            'status' => 'success',
            'message' => 'all Matches',
            'matchs' => $matchs,
        ]);    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGameRequest $request)
    {
        $validatedData=$request->validated();
        $game=$this->GameService->AjouterGame($validatedData);

    return response()->json([
        'status' => 'success',
        'message' => 'Match created successfully',
        'data' => $game,
    ]);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, $id)
    {
        $validatedData = $request->validated();
    
      $game=$this->GameService->UpdateGame($validatedData,$id);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Match updated successfully',
            'data' => $game
        ]);
    }



    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $match=Game::findOrFail($id);
        $match->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Match deleted successfully'
        ]);
    }




    
    public function ProgrammerGame(ProgrammerGameRequest $request, $id)
    {
        $validatedData = $request->validated();
    
      $game=$this->GameService->UpdateGame($validatedData,$id);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Match updated successfully',
            'data' => $game
        ]);
    }



public function showAllUnscheduledMatches(){

    $games = $this->GameService->allUnscheduledMatches();
    return response()->json([
        'status' => 'success',
        'message' => ' all Unscheduled Matches  ',
        'games' => $games,
    ]);  
  }



public function updateDataAfterMatche(Request $request , $id ){


    $validatedData=$request->validate([
        'lieu'=>'required|string|max:100',
        'date_heure' => 'required|date_format:Y-m-d\TH:i',
        'score_exterieur'=>'nullable|integer|min:0',
        'score_domicile'=>'nullable|integer|min:0',
        'statut'=>'required|in:terminé,annulé,en cours,programmé ',
    ]);
    $match=Game::findOrFail($id);
    $match->update($validatedData);
    return response()->json([
        'status' => 'success',
        'message' => 'Match updated successfully',
        'match' => $match,
    ]);

}

public function addScoreToGame(Request $request , $id ){


    $validatedData=$request->validate([
       
        
        'score_exterieur'=>'required|integer|min:0',
        'score_domicile'=>'required|integer|min:0',
        'statut'=>'required|in:terminé,annulé,en cours,programmé ',
    ]);
    $match=Game::findOrFail($id);
    $match->update($validatedData);
    return response()->json([
        'status' => 'success',
        'message' => 'Match updated successfully',
        'match' => $match,
    ]);

}


// public function allScheduledMatchesByTeamId($id){
//     $matchs=Game::with(['equipeDomicile', 'equipeExterieur', 'arbitreCentral', 'assistant1', 'assistant2', 'delegue'])
//         ->where("statut", "!=", "à venir")
//         ->whereRelation('equipeExterieur',$id)
//         ->orWhereRelation('equipeDomicile',$id)
//         ->paginate(5);


//         return response()->json([
//             'status' => 'success',
//             'message' => 'Match updated successfully',
//             'match' => $matchs,
//         ]);
// }
public function allScheduledMatchesByTeamId($id)
{
    $matchs = Game::with(['equipeDomicile', 'equipeExterieur', 'arbitreCentral', 'assistant1', 'assistant2', 'delegue'])
        ->where('statut', '!=', 'à venir')
        ->where(function ($query) use ($id) {
            $query->whereRelation('equipeExterieur', 'id', $id)
                  ->orWhereRelation('equipeDomicile', 'id', $id);
        })
        ->paginate(5);

    return response()->json([
        'status' => 'success',
        'message' => 'Matchs récupérés avec succès',
        'matchs' => $matchs,
    ]);
}
public function allFinishedMatchesByTeamId($id)
{
    $matchs = Game::with(['equipeDomicile', 'equipeExterieur'])
        ->where('statut', '=', 'terminé')
        ->where(function ($query) use ($id) {
            $query->whereRelation('equipeExterieur', 'id', $id)
                  ->orWhereRelation('equipeDomicile', 'id', $id);
        })
        ->paginate(5);

    return response()->json([
        'status' => 'success',
        'message' => 'Matchs récupérés avec succès',
        'matchs' => $matchs,
    ]);
}


// public function showToDayMatches(){
//     $arbitreId=Auth()->id();
//     print_r($arbitreId);
//     $games = Game::with(['equipeDomicile', 'equipeExterieur'])->where('arbitre_central_id',$arbitreId)
//     ->where('date_heure', '>=', Carbon::now()->subHours(48))
//     ->orderBy('date_heure', 'desc')
//     ->get();
//     return response()->json([
//         'status' => 'success',
//         'message' => 'Matchs récupérés avec succès',
//         'matchs' => $games,
//     ]);
// }
public function showToDayMatches(){
    $user = Auth()->user();
    $userId=$user->id;
        $arbitre=Arbitre::where("user_id",$userId)->first();
        $arbitreId=$arbitre->id;

    $games = Game::with(['equipeDomicile', 'equipeExterieur'])
        ->where('arbitre_central_id', $arbitreId)
        ->where('date_heure', '>=', Carbon::now()->subHours(48)) 
        ->orderBy('date_heure', 'desc')
        ->get();

    return response()->json([
        'status' => 'success',
        'message' => 'Matchs récupérés avec succès',
        'matchs' => $games,
    ]);


}




}
