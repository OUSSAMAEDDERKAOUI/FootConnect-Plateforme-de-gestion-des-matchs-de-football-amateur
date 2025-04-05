<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blessure extends Model
{
    use HasFactory;

    protected $fillable = [
        'joueur_id',
        'game_id',
        'date_blessure',
        'type',
        'description',
        'retour_estime',
    ];

   
    public function joueur()
    {
        return $this->belongsTo(Joueur::class);
    }

    
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
