<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ligue extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_ligue',
        'region',
        'email',
        'password',
    ];
}
