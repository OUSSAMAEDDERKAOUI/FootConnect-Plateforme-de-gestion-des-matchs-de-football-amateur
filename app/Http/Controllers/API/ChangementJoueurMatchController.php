<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Models\ChangementJoueurMatch;
use App\Http\Requests\ChangementJoueurMatch\storeChangementJoueurMatch;
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



    public function store(storeChangementJoueurMatch $request)
    {
        $validatedData = $request->validated();

        $changement = $this->ChangementService->create($validatedData);

        return response()->json($changement, 201);
    }


    public function show($gameId)
    {
        $changements = ChangementJoueurMatch::where('game_id', $gameId)->get();

        return response()->json($changements);
    }
    public function destroy($id)
    {
        $changements = ChangementJoueurMatch::where('game_id', $id)->get();

        return response()->json($changements);
    }
}
