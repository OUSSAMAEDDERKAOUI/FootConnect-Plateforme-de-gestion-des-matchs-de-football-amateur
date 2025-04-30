<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'nationalite' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'telephone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:joueur,arbitre,delegue,entraineur,medecin',
            'photo' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'isBanned' => 'nullable|boolean',

        ];

        switch ($this->input('role')) {
            case 'joueur':
                $rules += [
                    'equipe_id' => 'required|exists:equipes,id',
                    'numeroMaillot' => 'required|integer|min:1',
                    'position' => 'required|string|in:gardien,defenseur,milieu,attaquant',
                    'statut' => 'required|string|max:255',
                ];
                break;

            case 'arbitre':
                $rules += [
                    'numero_accreditation' => 'required|string|max:255',
                    'niveau' => 'required|string|in:départemental,régional,national,international',
                    'poste' => 'required|string|in:arbitre central,assistant,vidéo',
                    'experience' => 'required|string|max:500',
                ];
                break;
                case 'delegue':
                    $rules += [
                        'numero_accreditation' => 'required|string|max:255',
                        'niveau' => 'required|string|in:régional,national,international',
                        'experience' => 'required|string|max:500',
                        
                    ];
                    break;

            case 'entraineur':
                $rules += [
                    'experience' => 'required|string|max:500',
                    'licence' => 'required|string|max:255',
                    'role_entraineur' => 'required|string|in:principal,adjoint,préparateur physique',
                    'statut' => 'required|string|max:255',
                    'equipe_id' => 'required|exists:equipes,id',

                ];
                break;

            case 'medecin':
                $rules += [
                    'licence' => 'required|string|max:255',
                    'specialite' => 'required|string|in:Traumatologie,Traumatologie,Médecine générale',
                    'statut' => 'required|string|max:255',
                    'equipe_id' => 'required|exists:equipes,id',

                ];
                break;
        }

        return $rules;
    }
}
