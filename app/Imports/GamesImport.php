<?php

namespace App\Imports;

use App\Models\Game;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Support\Facades\DB;

class GamesImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    protected $ligue_id;
    protected $errors = [];
    protected $imported = 0;

    public function __construct($ligue_id)
    {
        $this->ligue_id = 1;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            try {
                DB::beginTransaction();
                
                $game = Game::create([
                    'nombre_journée' => $row['nombre_journee'],
                    'equipe_domicile_id' => $row['equipe_domicile_id'],
                    'equipe_exterieur_id' => $row['equipe_exterieur_id'],
                    'ligue_id' => $this->ligue_id,
                    'date_match' => isset($row['date_match']) ? $row['date_match'] : null,
                    'heure_match' => isset($row['heure_match']) ? $row['heure_match'] : null,
                    'stade' => isset($row['stade']) ? $row['stade'] : null,
                    'status' => isset($row['status']) ? $row['status'] : 'à venir', 
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
            'nombre_journee' => 'required|integer|max:30',
            'equipe_domicile_id' => 'required|exists:equipes,id',
            'equipe_exterieur_id' => 'required|exists:equipes,id|different:equipe_domicile_id',
            'date_match' => 'nullable|date',
            'heure_match' => 'nullable|date_format:H:i',
            'stade' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:programmé,en cours,terminé,à venir,annulé',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'equipe_domicile_id.exists' => 'L\'équipe à domicile sélectionnée n\'existe pas.',
            'equipe_exterieur_id.exists' => 'L\'équipe à l\'extérieur sélectionnée n\'existe pas.',
            'equipe_exterieur_id.different' => 'Les équipes à domicile et à l\'extérieur doivent être différentes.',
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
