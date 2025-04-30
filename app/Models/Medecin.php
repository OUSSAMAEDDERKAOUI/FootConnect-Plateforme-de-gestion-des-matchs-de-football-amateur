<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'licence',
        'specialite',
        'statut',
        'equipe_id',
    ];
    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }
}
