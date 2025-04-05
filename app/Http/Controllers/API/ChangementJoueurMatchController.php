<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;


use App\Models\ChangementJoueurMatch;
use Illuminate\Http\Request;

class ChangementJoueurMatchController extends Controller
{
    protected $ChangementJoueurMatchService;
    public function __construct(ChangementJoueurMatchService $ChangementJoueurMatchService){
        $this->ChangementJoueurMatchService=$ChangementJoueurMatchService;
    }
    public function store(Request $request)
    {
        $validatedData = $request->validated();

        $changement = ChangementJoueurMatch::create([
            'game_id' => $validated['game_id'],
            'joueur_entreée_id' => $validated['joueur_entreée_id'],
            'joueur_sortie_id' => $validated['joueur_sortie_id'],
            'equipe_id' => $validated['equipe_id'],
            'minute' => $validated['minute'],
        ]);

        return response()->json($changement, 201);
    }

 
    public function getByMatch($gameId)
    {
        $changements = ChangementJoueurMatch::where('game_id', $gameId)->get();

        return response()->json($changements);
    }
}
