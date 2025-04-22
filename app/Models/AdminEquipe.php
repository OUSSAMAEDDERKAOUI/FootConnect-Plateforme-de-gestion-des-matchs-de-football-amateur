<?php

namespace App\Models;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AdminEquipe extends Authenticatable implements JWTSubject 
{
    use HasApiTokens,  HasFactory, Notifiable;
    protected $table = 'admin_equipes';

    protected $fillable = [
        'equipe_id', 
        'telephone',
        'email', 
        'password',
        'isBanned',
    ];

    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }
 


    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return [
        'email'=>$this->email,
        'name'=>$this->name
      ];
    }
}
