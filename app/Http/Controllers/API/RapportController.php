<?php

namespace App\Http\Controllers\API;
use App\Models\Game;
use App\Models\Rapport;
use App\Models\AdminEquipe;
use Illuminate\Http\Request;
use App\Mail\RapportMatchMail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Jobs\SendRapportMatchJob;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Services\RapportService\RapportService;
use App\Http\Requests\RapportRequest\StoreRapportRequest;

class RapportController extends Controller
{
    protected $rapportService;

    public function __construct(RapportService $rapportService)
    {
        $this->rapportService = $rapportService;
    }

    public function index()
    {
        return response()->json($this->rapportService->getAll());
    }

    public function store(StoreRapportRequest $request)
    {
        $data = $request->validated();

        return response()->json($this->rapportService->store($data), 201);
    }

    public function show($id)
    {
        return response()->json($this->rapportService->getById($id));
    }

    public function update(StoreRapportRequest $request, $id)
    {
        $data = $request->validated();

        return response()->json($this->rapportService->update($id, $data));
    }

    public function destroy($id)
    {
        
        $this->rapportService->destroy($id);

        return response()->json(['message' => 'Rapport supprimé avec succès']);
    }





    public function generatePDF($gameId)
    {
        try {
            $game = Game::with(['equipeDomicile', 'equipeExterieur', 'rapport', 'buts.joueur.user', 'sanctions.joueur.user', 'changements.joueurEntree.user','changements.joueurSortie.user','arbitreCentral.user','assistant1.user','assistant2.user','delegue.user',])
                ->findOrFail($gameId);



                $equipeDomicileId=$game->equipeDomicile->id;
$adminEquipeDomicile = AdminEquipe::where('equipe_id', $equipeDomicileId)->firstOrFail();
$adminEquipeDomicileEmail=$adminEquipeDomicile->email;
// dd($adminEquipeDomicileEmail);

$equipeExterieurId=$game->equipeExterieur->id;
$adminEquipeExterieur=AdminEquipe::where('equipe_id', $equipeExterieurId)->firstOrFail();
$adminEquipeExterieurEmail=$adminEquipeExterieur->email;
// dd($adminEquipeExterieurEmail);

            $rapport = $game->rapport;
            
            if (!$rapport) {
                return response()->json(['status' => 'error', 'message' => 'Aucun rapport trouvé pour ce match'], 404);
            }
            
            $data = [
                'game' => $game,
                'equipe_exterieur'=>$game->equipeExterieur,
                'equipe_domicile'=>$game->equipeDomicile,
                'rapport' => $rapport,
                'date' => now()->format('d/m/Y'),
                'buteurs' => $game->buts,
                'sanctions' => $game->sanctions,
                'changements' => $game->changements,
                'arbitreCentral' => $game->arbitreCentral,
                'assistant1' => $game->assistant1,
                'assistant2' => $game->assistant2,
                'delegue' => $game->delegue,
            ];
            
// dd($data);

            $pdf = PDF::loadView('pdf.rapport_match', $data);
           
            $equipe_domicile = $game->equipeDomicile;
            $equipe_exterieur = $game->equipeExterieur;
            $buteurs = $game->buts;
            $sanctions = $game->sanctions;
            $changements = $game->changements;
            $arbitreCentral = $game->arbitreCentral;
            $assistant1 = $game->assistant1;
            $assistant2 = $game->assistant2;
            $delegue = $game->delegue;
            $date = now()->format('d/m/Y');
            
$data = compact(
    'game',
    'rapport',
    'date',
    'equipe_domicile',
    'equipe_exterieur',
    'buteurs',
    'sanctions',
    'changements',
    'arbitreCentral',
    'assistant1',
    'assistant2',
    'delegue'
);

SendRapportMatchJob::dispatch($data, $adminEquipeDomicileEmail);
SendRapportMatchJob::dispatch($data, $adminEquipeExterieurEmail);

// Mail::to($adminEquipeDomicileEmail)->send(new RapportMatchMail($data));
// Mail::to($adminEquipeExterieurEmail)->send(new RapportMatchMail($data));


            $filename = 'rapport_match_' . $game->equipeDomicile->nom . '_vs_' . $game->equipeExterieur->nom . '_' . now()->format('Y-m-d') . '.pdf';
            
            return $pdf->download($filename);
            
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
