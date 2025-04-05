<?php 
namespace App\Http\Requests\BlessureRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlessureRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'joueur_id' => 'required|exists:joueurs,id',
            'game_id' => 'nullable|exists:games,id',
            'date_blessure' => 'required|date',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'retour_estime' => 'nullable|date',
        ];
    }

    
}
