<?php
namespace App\Imports;

use App\Models\User;
use App\Models\Joueur;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\DB;

class PlayersImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    protected $equipe_id;
    protected $errors = [];
    protected $imported = 0;

    public function __construct($equipe_id)
    {
        $this->equipe_id = $equipe_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            try {
                DB::beginTransaction();
                
                $user = User::create([
                    'prenom' => $row['prenom'],
                    'nom' => $row['nom'],
                    'nationalite' => $row['nationalite'],
                    'date_naissance' => $row['date_naissance'],
                    'telephone' => $row['telephone'],
                    'email' => $row['email'],
                    'password' => Hash::make($row['password'] ?? 'password123'), 
                    'role' => 'joueur',
                    'isBanned' => false,
                    'photo' => $row['photo'] ?? null, 
                ]);

                Joueur::create([
                    'equipe_id' => $this->equipe_id,
                    'numeroMaillot' => $row['numero_maillot'],
                    'position' => $row['position'],
                    'statut' => $row['statut'] ?? 'actif', 
                    'user_id' => $user->id,
                ]);

                $this->imported++;
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->errors[] = "Ligne " . ($this->imported + 1) . ": " . $e->getMessage();
            }
        }
    }

    public function rules(): array
    {
        return [
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'nationalite' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'telephone' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'numero_maillot' => 'required|integer',
            'position' => 'required|string|max:255',
            'statut' => 'nullable|string|in:actif,inactif,blessé,suspendu',
            'photo' => 'nullable|url',

        ];
    }

    public function customValidationMessages()
    {
        return [
            'email.unique' => 'L\'email :input est déjà utilisé.',
            'numero_maillot.integer' => 'Le numéro de maillot doit être un nombre.',
        ];
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getImportedCount()
    {
        return $this->imported;
    }
}