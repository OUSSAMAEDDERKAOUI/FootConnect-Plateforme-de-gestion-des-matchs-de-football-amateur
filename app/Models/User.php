<?php

namespace App\Models;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject; 

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject 
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prenom',
        'nom',
        'nationalite',
        'date_naissance',
        'telephone',
        'photo',
        'isBanned',
        'email',
        'password',
        'role',
    ];

public function joueur(){
    return $this->hasOne(Joueur::class,'user_id');
}

public function arbitre(){
    return $this->hasOne(Arbitre::class,'user_id');
}
public function delegue(){
    return $this->hasOne(Delegue::class,'user_id');
}

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];





  
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

