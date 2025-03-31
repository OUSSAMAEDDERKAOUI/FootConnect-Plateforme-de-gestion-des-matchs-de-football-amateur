<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
