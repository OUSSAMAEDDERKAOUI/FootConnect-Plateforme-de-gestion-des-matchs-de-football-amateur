<?php
namespace App\Http\Requests\EquipeRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
           'nom' => 'required|string|max:255',
            'telephone' => 'required|string|regex:/^0[5-7][0-9]{8}$/',
            'logo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', 
            'categorie' => 'required|in:U13,U15,U17,U19,U23,Senior',
        ];
    }
}
