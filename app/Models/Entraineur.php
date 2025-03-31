<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entraineur extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'experience',
        'licence',
        'role_entraineur',
        'statut',
    ];
}
