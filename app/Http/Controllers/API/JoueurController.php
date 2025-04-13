<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Joueur;
use Illuminate\Http\Request;

class JoueurController extends Controller
{


    public function validatePlayer($id){


        $player = Joueur::findOrFail($id);

      
        $player->validation_status = "validé"; 
        $player->save();

        return response()->json([
            'message' => 'Le joueur a été validé avec succès.',
            'player' => $player
        ], 200);

    }
    public function rejectPlayer($id){


        $player = Joueur::findOrFail($id);

      
        $player->validation_status = "rejeté"; 
        $player->save();

        return response()->json([
            'message' => 'Le joueur a été rejeté avec succès.',
            'player' => $player
        ], 200);

    }
}


