<?php 
// 
namespace App\Repositories\GameRepository;

use App\Http\Requests\Games\StoreGameRequest;
use App\Models\User;
use App\Models\Joueur;
use App\Models\Medecin;
use App\Models\Entraineur;
use App\Models\Arbitre;
use App\Models\Delegue;
use App\Models\Game;


class GameRepository
{
    protected $GameModel;

    public function __construct(Game $GameModel)
    {
        $this->GameModel = $GameModel;
    }

    public function allScheduledMatches()
    {
        return Game::with(['equipeDomicile', 'equipeExterieur', 'arbitreCentral', 'assistant1', 'assistant2', 'delegue'])->whereNotNull("lieu")->paginate(5);
    }

    public function allUnscheduledMatches()
    {
        return Game::with(['equipeDomicile', 'equipeExterieur'])->whereNull('lieu')->orWhere('statut', 'non_programmé')->paginate(5);
    }


    public function matchNonProgramé()
    {
        return Game::with(['equipeDomicile', 'equipeExterieur', 'arbitreCentral', 'assistant1', 'assistant2', 'delegue'])->where("lieu","=","null")->get();
    }






public function AjouterGame(array $gameData){
    $gameData['ligue_id'] = 1;

    $game = Game::create($gameData);

    return $game;


}

public function UpdateGame(array $gameData, $id)
{
     $match = Game::findOrFail($id);

  if (
        isset($gameData["date_heure"]) && !empty($gameData["date_heure"]) &&
        isset($gameData["lieu"]) && !empty($gameData["lieu"]) &&
        isset($gameData["arbitre_central_id"]) && !empty($gameData["arbitre_central_id"]) &&
        isset($gameData["assistant_1_id"]) && !empty($gameData["assistant_1_id"]) &&
        isset($gameData["assistant_2_id"]) && !empty($gameData["assistant_2_id"]) &&
        isset($gameData["delegue_id"]) && !empty($gameData["delegue_id"])
    ) {
        $gameData['statut'] = 'programmé';
    }

     $match->update($gameData);

     return  $match;
}







}