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

public function ProgrammerGame(array $gameData, $id)
{
     $match = Game::findOrFail($id);
    
     $match->update($gameData);
     return  $match;
}







}