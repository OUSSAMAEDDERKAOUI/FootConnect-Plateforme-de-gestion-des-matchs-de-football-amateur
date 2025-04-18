<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\Joueur;
use App\Models\Sanction;
use Illuminate\Console\Command;
use App\Jobs\ReactiverJoueursSuspendusJob;

class ReactiverJoueursSuspendus extends Command
{
    protected $signature = 'joueurs:update-statut';
    protected $description = 'REActive les joueurs suspendus après la DErniere match de suspension.';

   
    
    public function handle()
    {

        $joueursSuspendus = Joueur::where('statut', 'suspendu')->get();

        foreach ($joueursSuspendus as $joueur) {

            ReactiverJoueursSuspendusJob::dispatch($joueur->id);
        }

    }

    
    
}


