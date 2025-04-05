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

    public function messages()
    {
        return [
            'joueur_id.required' => 'Le joueur est obligatoire.',
            'joueur_id.exists' => 'Le joueur spécifié n\'existe pas.',
            'game_id.exists' => 'La partie spécifiée n\'existe pas.',
            'date_blessure.required' => 'La date de la blessure est obligatoire.',
            'date_blessure.date' => 'La date de la blessure doit être une date valide.',
            'type.required' => 'Le type de blessure est obligatoire.',
            'type.string' => 'Le type de blessure doit être une chaîne de caractères.',
            'type.max' => 'Le type de blessure ne peut pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne peut pas dépasser 1000 caractères.',
            'retour_estime.date' => 'La date de retour estimée doit être une date valide.',
        ];
    }
}
