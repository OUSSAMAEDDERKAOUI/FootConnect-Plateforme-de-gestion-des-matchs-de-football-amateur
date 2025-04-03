<?php

namespace App\Http\Requests\Games;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
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
        'nombre_journée' => 'required|integer|max:30',
        'equipe_domicile_id' => 'required|exists:equipes,id',
        'equipe_exterieur_id' => 'required|exists:equipes,id',
        'ligue_id' => 'required|exists:ligues,id',
        'date_heure' => 'nullable|date',
        'lieu' => 'nullable|string|max:255',
        'score_domicile' => 'nullable|integer',
        'score_exterieur' => 'nullable|integer',
        'arbitre_central_id' => 'nullable|exists:arbitres,id',
        'assistant_1_id' => 'nullable|exists:arbitres,id',
        'assistant_2_id' => 'nullable|exists:arbitres,id',
        'delegue_id' => 'nullable|exists:users,id',
        ];
    }
}
