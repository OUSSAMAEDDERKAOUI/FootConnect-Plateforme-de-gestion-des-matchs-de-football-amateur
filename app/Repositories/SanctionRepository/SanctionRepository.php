<?php 

namespace App\Repositories\SanctionRepository;
use App\Models\Sanction;
use App\Models\Joueur;
use App\Models\Game;
use Illuminate\Http\Request;

class SanctionRepository{

private $SanctionModel ;
 

public function __construct(Sanction $SanctionModel){
    $this->SanctionModel=$SanctionModel;

}










public function ajouterSanction(array $SanctionData)
{
    $sanction = Sanction::create($SanctionData);

    if ($SanctionData["type"] === 'Carton Rouge') {
         $default = 1 ;
        $this->suspendirJoueur($SanctionData["joueur_id"], $SanctionData["game_id"], $default);
    }
    else if ($SanctionData["type"] === 'Carton Jaune') {
        $yellowCardCount = Sanction::where('joueur_id', $SanctionData["joueur_id"])
            ->where('type', 'Carton Jaune')
            ->count();

        $matchsDeSuspension = floor($yellowCardCount / 4); 

        if ($matchsDeSuspension >= 1 && $yellowCardCount % 4 === 0) {
            $this->suspendirJoueur($SanctionData["joueur_id"], $SanctionData["game_id"], $matchsDeSuspension);
        }
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Sanction enregistrée',
        'sanction' => $sanction
    ]);
}


private function suspendirJoueur($joueurId, $game_id, $nbMatchs)
{
    $joueur = Joueur::findOrFail($joueurId);
    $equipeId = $joueur->equipe_id;

    $game = Game::findOrFail($game_id);
    $currentJournee = $game->nombre_journée;

    $nextMatches = Game::where('nombre_journée', '>', $currentJournee)
        ->where(function ($query) use ($equipeId) {
            $query->where('equipe_domicile_id', $equipeId)
                  ->orWhere('equipe_exterieur_id', $equipeId);
        })
        ->orderBy('nombre_journée', 'asc')
        ->limit($nbMatchs)
        ->get();

    foreach ($nextMatches as $match) {
        Sanction::create([
            'game_id' => $match->id,
            'joueur_id' => $joueurId,
            'type' => 'Suspension',
            'date_time' => now(),
            'note' => "Suspension automatique ."
        ]);
    }

    if ($nextMatches->isNotEmpty()) {
        $joueur->update(['statut' => 'suspendu']);
    }
}







public function ajouterDureeSanction(array $SanctionData, $SanctionId)
{
    $sanction = Sanction::findOrFail($SanctionId);
    $nbMatchs = $SanctionData["nbr_matchs"];

    $joueur = Joueur::findOrFail($SanctionData["joueur_id"]);
    $equipeId = $joueur->equipe_id;

    $game = Game::findOrFail($SanctionData["game_id"]);
    $currentJournee = $game->nombre_journée;

    $oldSanction = Sanction::where('joueur_id', $joueur->id)
        ->where('type', 'Suspension')
        ->whereHas('game', function ($query) use ($currentJournee) {
            $query->where('nombre_journée', '>', $currentJournee);
        })
        ->pluck('game_id')
        ->toArray();

    $matchsCounter = $nbMatchs - count($oldSanction);

    if ($matchsCounter > 0) {
        $nextMatches = Game::where('nombre_journée', '>', $currentJournee)
            ->where(function ($query) use ($equipeId) {
                $query->where('equipe_domicile_id', $equipeId)
                      ->orWhere('equipe_exterieur_id', $equipeId);
            })
            ->whereNotIn('id', $oldSanction) 
            ->orderBy('nombre_journée')
            ->limit($matchsCounter)
            ->get();

        foreach ($nextMatches as $match) {
            Sanction::create([
                'game_id' => $match->id,
                'joueur_id' => $joueur->id,
                'type' => 'Suspension',
                'date_time' => now(),
                'note' => "Suspension automatique après carton rouge.",
            ]);
        }
    }

    $sanction->update([
        'duree' => $nbMatchs,
    ]);

    if ($nbMatchs > 0) {
        $joueur->update(['statut' => 'suspendu']);
    }

    return $sanction;
}





public function deleteSanction( $SanctionId){

    $sanction=Sanction::findOrFail($SanctionId);

    $sanction->delete();
    return $sanction;

}


}