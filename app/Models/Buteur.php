<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buteur extends Model
{
    use HasFactory;

    // Définir les champs qui peuvent être assignés en masse
    protected $fillable = [
        'game_id',
        'joueur_id',
        'minute',
    ];

    // Si nécessaire, vous pouvez ajouter des relations, par exemple :
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function joueur()
    {
        return $this->belongsTo(Joueur::class, 'joueur_id');
    }
}
