<?php

namespace App\Http\Controllers;

use App\Imports\GamesImport;
use App\Exports\GamesTemplateExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Validators\ValidationException;
use App\Models\Ligue;
use App\Models\Equipe;

class GameImportController extends Controller
{
    public function showImportForm()
    {
        $ligue = Ligue::where("id", 1)->first(); 
        // dd($ligues);
        return view('adminLigue.import-games', compact('ligue'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
            'ligue_id' => 'required|exists:ligues,id',
        ]);

        try {
            $headings = (new HeadingRowImport)->toArray($request->file('file'))[0][0];
            
            $requiredHeadings = ['nombre_journee', 'equipe_domicile_id', 'equipe_exterieur_id'];
            
            $missingHeadings = array_diff($requiredHeadings, array_keys($headings));
            
            // if (!empty($missingHeadings)) {
            //     return back()->with('error', 'Le fichier ne contient pas tous les en-têtes requis: ' . implode(', ', $missingHeadings));
            // }

            $import = new GamesImport($request->ligue_id);
            Excel::import($import, $request->file('file'));

            $message = "Importation terminée! " . $import->getImportedCount() . " matchs importés avec succès.";
            
            if (!empty($import->getErrors())) {
                $message .= " Erreurs rencontrées: " . implode("; ", $import->getErrors());
            }

            return back()->with('success', $message);
            
        } catch (ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            
            foreach ($failures as $failure) {
                $errors[] = "Ligne {$failure->row()}: {$failure->errors()[0]}";
            }
            
            return back()->with('error', 'Erreurs de validation: ' . implode('; ', $errors));
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'importation: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $equipes = Equipe::select('id', 'nom')->get();
        $equipesString = $equipes->map(function ($equipe) {
            return $equipe->id . ' - ' . $equipe->nom;
        })->implode(', ');

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="modele_import_matchs.xlsx"',
        ];

        return Excel::download(new GamesTemplateExport($equipesString), 'modele_import_matchs.xlsx', \Maatwebsite\Excel\Excel::XLSX, $headers);
    }
}
