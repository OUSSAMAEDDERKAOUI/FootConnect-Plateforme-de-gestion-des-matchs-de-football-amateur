<?php

namespace App\Http\Controllers\API;
use App\Models\Joueur;
use App\Models\Sanction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Buteur;

class JoueurController extends Controller
{


    public function getPlayerDetails($id){


        $player = Joueur::with(['user','equipe'])->findOrFail($id);
$sanction=Sanction::where('joueur_id',$player->id)->count();
$buts=Buteur::where('joueur_id',$player->id)->count();
      

        return response()->json([
            'message' => 'Le joueur a été validé avec succès.',
            'player' => $player,
            'sanction' => $sanction,
             'buts' => $buts
        ], 200);

    }



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


