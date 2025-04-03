<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLigue extends Model
{
    use HasFactory;
    protected $table='admin_ligues';
    protected $fillable = [
        'ligue_id',
        'email',
        'password',
    ];
}
