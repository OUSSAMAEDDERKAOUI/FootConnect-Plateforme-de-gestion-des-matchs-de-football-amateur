<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rapport extends Model
{
    use HasFactory;
    protected $fillable=[
        'game_id',
        'reserves',
        'observations',
    ];

public function game(){
    return $this->BelongsTo(Game::class,'game_id');
}

}
