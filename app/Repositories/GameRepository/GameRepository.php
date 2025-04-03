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


public function AjouterGame(array $gameData){

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