<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arbitre extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_accreditation',
        'niveau',
        'poste',
        'experience',
    ];

}
