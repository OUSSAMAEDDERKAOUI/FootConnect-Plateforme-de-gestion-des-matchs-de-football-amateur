<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject; 

use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminLigue extends Authenticatable implements JWTSubject 

{
    use HasFactory;
    protected $table='admin_ligues';
    protected $fillable = [
        'ligue_id',
        'email',
        'password',
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
