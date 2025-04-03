<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delegue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'numero_accreditation',
        'niveau',
        'experience',
        'statut',
    ];
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
}
