<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangementJoueurMatch extends Model
{
    use HasFactory;
    protected $table='changement_joueur_matchs' ;
    protected $fillable = [
        'game_id',
        'joueur_entreée_id',
        'joueur_sortie_id', 
        'equipe_id',
        'minute',
    ];

   
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

   
    public function joueurEntree()
    {
        return $this->belongsTo(Joueur::class, 'joueur_entreée_id');
    }


    public function joueurSortie()
    {
        return $this->belongsTo(Joueur::class, 'joueur_sortie_id');
    }

    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }
}
