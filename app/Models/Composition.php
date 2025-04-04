<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Composition extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'joueur_id', 'statut'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function joueur()
    {
        return $this->belongsTo(Joueur::class);
    }
}

