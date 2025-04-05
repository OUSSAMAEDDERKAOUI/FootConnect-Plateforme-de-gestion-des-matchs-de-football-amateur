<?php

namespace App\Http\Requests\ChangementJoueurMatch;

use Illuminate\Foundation\Http\FormRequest;

class storeChangementJoueurMatch extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'game_id' => 'required|exists:games,id', 
            'joueur_entreée_id' => 'required|exists:joueurs,id', 
            'joueur_sortie_id' => 'required|exists:joueurs,id', 
            'equipe_id' => 'required|exists:equipes,id', 
            'minute' => 'required|date_format:H:i', 
                ];
    }
}
