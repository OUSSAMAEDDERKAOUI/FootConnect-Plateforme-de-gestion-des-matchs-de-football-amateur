<?php

namespace App\Models;

use App\Models\Joueur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 
        'telephone',
        'logo',
        'categorie',
        'statut',
    ];



    public function joueurs(){
        return $this->hasMany(Joueur::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
    public function adminEquipe(){
        return $this->belongsTo(adminEquipe::class);
    }
}
