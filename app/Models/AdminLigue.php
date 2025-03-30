<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLigue extends Model
{
    use HasFactory;
    protected $fillable = [
        'ligue_id',
        'email',
        'password',
    ];
}
