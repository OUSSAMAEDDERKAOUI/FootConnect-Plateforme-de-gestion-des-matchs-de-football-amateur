<?php

namespace App\Services\GameService;

use App\Models\Game;
use App\Repositories\GameRepository\GameRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GameService
{
    protected $GameRepository;

    public function __construct(GameRepository $GameRepository)
    {
        $this->GameRepository = $GameRepository;
    }


    public function allScheduledMatches(){
    $games=$this->GameRepository->allScheduledMatches();
    return $games ;
}

public function allUnscheduledMatches(){
    $games=$this->GameRepository->allUnscheduledMatches();
    return $games ;
}


    public function AjouterGame(array $gameData){
        
        
        $game=$this->GameRepository->AjouterGame($gameData);


        return $game;

    }

    public function UpdateGame(array $gameData , $id){
        
        
        $game=$this->GameRepository->UpdateGame($gameData,$id);


        return $game;

       
    }

   




}