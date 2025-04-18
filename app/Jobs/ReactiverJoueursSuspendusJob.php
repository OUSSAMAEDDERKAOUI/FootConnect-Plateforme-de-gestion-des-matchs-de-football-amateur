<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\Joueur;
use App\Models\Sanction;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ReactiverJoueursSuspendusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $joueurId;

    public function __construct($joueurId)
    {
        $this->joueurId = $joueurId;
    }

    public function handle()
    {
        $joueur = Joueur::find($this->joueurId);

        if ($joueur && $joueur->statut === 'suspendu') {
            $derniereSuspension = Sanction::where('joueur_id', $joueur->id)
                ->where('type', 'Suspension')
                ->orderBy('date_time', 'desc')
                ->first();

            if ($derniereSuspension) {
                $match = Game::find($derniereSuspension->game_id);

                if ($match && Carbon::parse($match->date_heure)->isPast()) {
                    $joueur->update(['statut' => 'actif']);
                }
            }
        }
    }
}
