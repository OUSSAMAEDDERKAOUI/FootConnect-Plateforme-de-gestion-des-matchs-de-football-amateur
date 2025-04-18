<?php

namespace App\Models;

use App\Models\Equipe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Joueur extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'equipe_id', 
        'numeroMaillot', 
        'position', 
        'statut',
    ];
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
    
    public function buts(){
        return $this->hasMany(Buteur::class,'game_id');
    }

    public function equipe(){
        return $this->belongsTo(Equipe::class);
    }

    public function blessures()
    {
        return $this->hasMany(Blessure::class);
    }

}
