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



    public function AjouterGame(array $gameData){
        
        
        $game=$this->GameRepository->AjouterGame($gameData);


        return $game;

    }

    public function ProgrammerGame(array $gameData , $id){
        
        
        $game=$this->GameRepository->ProgrammerGame($gameData,$id);


        return $game;

       
    }

   




}