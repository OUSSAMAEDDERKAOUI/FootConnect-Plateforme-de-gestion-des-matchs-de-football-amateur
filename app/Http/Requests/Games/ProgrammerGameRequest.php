<?php

namespace App\Http\Requests\Games;

use Illuminate\Foundation\Http\FormRequest;

class ProgrammerGameRequest extends FormRequest
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
        'ligue_id' => 'nullable|exists:ligues,id',
        'date_heure' => 'required|date',
        'lieu' => 'required|string|max:255',
        'score_domicile' => 'nullable|integer',
        'score_exterieur' => 'nullable|integer',
        'arbitre_central_id' => 'required|exists:arbitres,id',
        'assistant_1_id' => 'required|exists:arbitres,id',
        'assistant_2_id' => 'required|exists:arbitres,id',
        'delegue_id' => 'required|exists:users,id',
        ];
    }
}
