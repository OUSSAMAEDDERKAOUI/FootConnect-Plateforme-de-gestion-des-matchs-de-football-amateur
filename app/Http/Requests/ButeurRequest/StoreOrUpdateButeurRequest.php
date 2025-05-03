<?php
namespace App\Http\Requests\ButeurRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateButeurRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'game_id' => 'required|exists:games,id',
            'joueur_id' => 'required|exists:joueurs,id',
            'minute' => 'required|string',
        ];
    }
}
