<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateCompositionRequest extends FormRequest
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
            'statut' => 'required|in:titulaire,remplaçant',
        ];
    }
}
