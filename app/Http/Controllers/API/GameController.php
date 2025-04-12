<?php

namespace App\Http\Controllers\API;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use App\Services\GameService\GameService;
use App\Http\Requests\Games\StoreGameRequest;
use App\Http\Requests\Games\UpdateGameRequest;
use App\Http\Requests\Games\ProgrammerGameRequest;

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



}
