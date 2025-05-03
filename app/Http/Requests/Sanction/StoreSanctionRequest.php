<?php

namespace App\Http\Requests\Sanction;

use Illuminate\Foundation\Http\FormRequest;

class StoreSanctionRequest extends FormRequest
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
            
                'game_id'=>'required|exists:games,id',
                'joueur_id'=>'required|exists:joueurs,id',
                'type'=>'required|in:Carton Jaune,Carton Rouge,Avertissement,Suspension',
                'date_time'=>'required|date', 
                'minute'=>'required|string',
                'duree'=>'nullable|string', 
                'note'=>'nullable|string',
            
        ];
    }
}
