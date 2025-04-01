<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminEquipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'equipe_id', 
        'telephone',
        'email', 
        'password',
        'isBanned',
    ];
}
