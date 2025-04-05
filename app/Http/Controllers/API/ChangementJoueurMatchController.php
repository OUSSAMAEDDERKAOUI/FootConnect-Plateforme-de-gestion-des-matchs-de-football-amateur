<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Models\ChangementJoueurMatch;
use App\Services\ChangementJoueurMatchService\ChangementJoueurMatchService;

class ChangementJoueurMatchController extends Controller
{
    protected $ChangementService;


    public function __construct(ChangementJoueurMatchService $ChangementService){
        $this->ChangementService=$ChangementService;
    }


public function index(){

   $response =  $this->ChangementService->all();

    return response()->json([
        "message" =>"toutes les  Changements des Joueurs ",
        "changements"=> $response,
    ]);
}



    // public function store(Request $request)
    // {
    //     $validatedData = $request->validated();

    //     $changement = $ChangementService->

    //     return response()->json($changement, 201);
    // }


    // public function getByMatch($gameId)
    // {
    //     $changements = ChangementJoueurMatch::where('game_id', $gameId)->get();

    //     return response()->json($changements);
    // }
}
