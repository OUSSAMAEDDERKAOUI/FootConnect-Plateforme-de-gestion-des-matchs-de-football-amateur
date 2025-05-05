<?php

use App\Models\Equipe;
use App\Models\Joueur;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GameController;
use App\Http\Controllers\API\ButeurController;
use App\Http\Controllers\API\EquipeController;
use App\Http\Controllers\API\JoueurController;
use App\Http\Controllers\API\ArbitreController;
use App\Http\Controllers\API\DelegueController;
use App\Http\Controllers\API\RapportController;
use App\Http\Controllers\API\BlessureController;
use App\Http\Controllers\API\SanctionController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\CompositionController;
use App\Http\Controllers\API\Auth\AdminLigueController;
use App\Http\Controllers\API\Auth\AdminEquipeController;
use App\Http\Controllers\API\ChangementJoueurMatchController;
use App\Http\Controllers\API\GameController as APIGameController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login/AdminEquipe',[AdminEquipeController::class,'loginAdminEquipe']);
Route::post('login/AdminLigue',[AdminLigueController::class,'loginAdminLigue']);


Route::post('login', [AuthController::class,'login']);
Route::post('refresh', [AuthController::class,'refresh']);
Route::post('logout', [AuthController::class,'logout']);




Route::middleware(['auth:api_admin_ligue', 'CheckRole:admin_ligue'])->group(function () {
Route::get('ligue/sanction',[SanctionController::class,"getAllSanctions"]);
Route::get('ligue/sanction/{sanctionId}',[SanctionController::class,"getSanctionsById"]);
Route::patch('matches/{game}/programmer', [GameController::class, 'ProgrammerGame']);
Route::put('equipe/{equipeId}/liste',[ EquipeController::class,'makeListTraité']);
Route::put('joueur/{id}/validate', [JoueurController::class, 'validatePlayer']);
Route::put('joueur/{id}/reject', [JoueurController::class, 'rejectPlayer']);
Route::post('register/AdminEquipe',[AdminEquipeController::class,'registerAdminEquipe']);
Route::post('/register', [ArbitreController::class, 'store']);
Route::apiResource('match',GameController::class);

Route::patch('/match/{matchId}/update',[GameController::class,'updateDataAfterMatche']);


Route::get('games', [GameController::class, 'showAllUnscheduledMatches']);

Route::get('equipe/liste',[ EquipeController::class,'getList']);

Route::post('register',[AuthController::class,'register']);

Route::apiResource('equipes', EquipeController::class);





Route::prefix('arbitre')->group(function () {
    Route::get('/', [ArbitreController::class, 'index']);
    Route::get('/{id}', [ArbitreController::class, 'show']);



    Route::put('/{id}', [ArbitreController::class, 'update']);
    Route::delete('/{id}', [ArbitreController::class, 'destroy']);
});


Route::prefix('delegue')->group(function () {
    Route::get('/', [DelegueController::class, 'index']);
    Route::get('/{id}', [DelegueController::class, 'show']);
    Route::post('/', [DelegueController::class, 'store']);
    Route::put('/{id}', [DelegueController::class, 'update']);
    Route::delete('/{id}', [DelegueController::class, 'destroy']);

});




});





Route::middleware(['auth:api','CheckRole:arbitre'])->group(function(){
    Route::get('/rapports/{game}/pdf', [RapportController::class, 'generatePDF']);

    Route::apiResource('changements', ChangementJoueurMatchController::class);

    Route::prefix('rapports')->group(function () {
        Route::get('/', [RapportController::class, 'index']);
        Route::get('/{id}', [RapportController::class, 'show']);
        Route::post('/', [RapportController::class, 'store']);
        Route::put('/{id}', [RapportController::class, 'update']);
        Route::delete('/{id}', [RapportController::class, 'destroy']);
    });

    Route::prefix('buteurs')->group(function () {
        Route::get('/', [ButeurController::class, 'index']);
        Route::get('/{id}', [ButeurController::class, 'show']);
        Route::post('/', [ButeurController::class, 'store']);
        Route::put('/{id}', [ButeurController::class, 'update']);
        Route::delete('/{id}', [ButeurController::class, 'destroy']);
    });


    Route::patch('/game/{matchId}/score',[GameController::class,'addScoreToGame']);


    Route::get('game/arbitre',[GameController::class,'showToDayMatches']);

});

Route::middleware(['CheckRole:admin_equipe,medecin,arbitre'])->get('/equipe/{teamId}/liste', [EquipeController::class, 'getPlayersTeam']);
Route::middleware(['CheckRole:admin_equipe,medecin'])->get('equipe/matchs/{equipeId}',[GameController::class,'allScheduledMatchesByTeamId']);
Route::middleware(['CheckRole:admin_equipe,medecin'])->get('joueur/{id}', [JoueurController::class, 'getPlayerDetails']);

Route::middleware(['CheckRole:admin_equipe,medecin'])->get('equipe/sanction/{sanctionId}',[SanctionController::class,"getSanctionsById"]);
Route::middleware(['CheckRole:admin_equipe,medecin,admin_ligue'])->get('equipe/liste/{teamId}',[ EquipeController::class,'getPlayersList']);
Route::middleware(['CheckRole:admin_equipe,medecin'])->get('equipe/{equipeId}/matchs',[GameController::class,'allFinishedMatchesByTeamId']);
Route::middleware(['CheckRole:admin_equipe,medecin'])->get('equipe/{equipeId}/sanctions',[SanctionController::class,"getSanctionsByEquipeId"]);
Route::middleware(['CheckRole:arbitre,admin_ligue'])->apiResource('sanction',SanctionController::class);




Route::post('blessures', [BlessureController::class, 'store']);



Route::middleware(['auth:api','CheckRole:medecin'])->group(function(){


Route::get('medecin/equipe', [EquipeController::class, 'getequipeIdbyMedecin']);


    Route::get('blessures', [BlessureController::class, 'index']);
Route::get('blessures/{id}', [BlessureController::class, 'show']);
Route::put('blessures/{id}', [BlessureController::class, 'update']);
Route::delete('blessures/{id}', [BlessureController::class, 'destroy']);

Route::put('blessure/{id}/finished',[BlessureController::class,'isHealthy']);


});






Route::get('sanctions/statistiques',[SanctionController::class,"statistiques"]);
Route::get('sanctions/equipe/{id}/statistiques',[SanctionController::class,"statistiquesByEquipe"]);







// Route::get('match/mostir', [GameController::class,'showToDayMatches']);

// Route::patch('/match/update/{matchId}',[GameController::class,'ProgrammerGame']);


// Route::get('medecin/equipe',[EquipeController::class,"getequipeIdbyMedecin"]);

// Route::middleware('auth:api')->get('arbitre/ligue', [ArbitreController::class, 'getArbitreId']);

// Route::apiResource('compositions', CompositionController::class);


// Route::middleware(['auth:api_admin_equipe','checkRole:adminEquipe'])->group(function(){






// });