<?php

namespace App\Http\Controllers;

use App\Imports\PlayersImport;
use App\Models\AdminEquipe;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Validators\ValidationException;
use App\Models\Equipe;
use Maatwebsite\Excel\Facades\Excel as ExcelExport;

class ImportController extends Controller
{
    public function showImportForm(Request $request)
    {
        $userId=$_COOKIE['User-ID'];
        $adminEquipe=AdminEquipe::findOrFail($userId);
        $equipeId=$adminEquipe->equipe_id;
       
        $equipes = Equipe::with('AdminEquipe')->where('id',$equipeId)->first();
        // dd($equipes);
       

        return view('adminEquipe.import-players', compact('equipes'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
            'equipe_id' => 'required|exists:equipes,id',
        ]);

        try {
            $headings = (new HeadingRowImport)->toArray($request->file('file'))[0][0];
            
            $requiredHeadings = ['prenom', 'nom', 'nationalite', 'date_naissance', 'telephone','email', 'password', 'numero_maillot','position','statut'];
            
            $missingHeadings = array_diff($requiredHeadings, array_keys($headings));

            // if (!empty($missingHeadings)) {
            //     return back()->with('error', 'Le fichier ne contient pas tous les en-têtes requis: ' . implode(', ', $missingHeadings));
            // }

            // Importer les joueurs
            $import = new PlayersImport($request->equipe_id);
            Excel::import($import, $request->file('file'));

            $message = "Importation terminée! " . $import->getImportedCount() . " joueurs importés avec succès.";
            
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
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="modele_import_joueurs.xlsx"',
        ];

        return ExcelExport::download(new \App\Exports\PlayersTemplateExport, 'modele_import_joueurs.xlsx', \Maatwebsite\Excel\Excel::XLSX, $headers);
    }
}
