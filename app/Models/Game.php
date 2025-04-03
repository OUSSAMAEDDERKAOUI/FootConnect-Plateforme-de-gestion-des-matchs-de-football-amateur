<?php

// app/Models/Match.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_journée',
        'equipe_domicile_id',
        'equipe_exterieur_id',
        'ligue_id',
        'date_heure',
        'lieu',
        'score_domicile',
        'score_exterieur',
        'arbitre_central_id',
        'assistant_1_id',
        'assistant_2_id',
        'delegue_id',
        'statut'
    ];

    // Relations avec d'autres modèles

    public function equipeDomicile()
    {
        return $this->belongsTo(Equipe::class, 'equipe_domicile_id');
    }

    public function equipeExterieur()
    {
        return $this->belongsTo(Equipe::class, 'equipe_exterieur_id');
    }

    public function arbitreCentral()
    {
        return $this->belongsTo(Arbitre::class, 'arbitre_central_id');
    }

    public function assistant1()
    {
        return $this->belongsTo(Arbitre::class, 'assistant_1_id');
    }

    public function assistant2()
    {
        return $this->belongsTo(Arbitre::class, 'assistant_2_id');
    }

    public function delegue()
    {
        return $this->belongsTo(User::class, 'delegue_id');
    }
}
