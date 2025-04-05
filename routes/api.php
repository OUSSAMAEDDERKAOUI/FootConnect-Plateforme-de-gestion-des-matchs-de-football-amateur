<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\GameController;
use App\Http\Controllers\API\ButeurController;
use App\Http\Controllers\API\RapportController;
use App\Http\Controllers\API\BlessureController;
use App\Http\Controllers\API\SanctionController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\CompositionController;
use App\Http\Controllers\API\Auth\AdminLigueController;
use App\Http\Controllers\API\Auth\AdminEquipeController;
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

Route::post('register/AdminEquipe',[AdminEquipeController::class,'registerAdminEquipe']);
Route::post('login/AdminEquipe',[AdminEquipeController::class,'loginAdminEquipe']);
Route::post('login/AdminLigue',[AdminLigueController::class,'loginAdminLigue']);

Route::post('register',[AuthController::class,'register']);

Route::post('login', [AuthController::class,'login']);
Route::post('refresh', [AuthController::class,'refresh']);
Route::post('logout', [AuthController::class,'logout']);




Route::apiResource('match',GameController::class);
Route::apiResource('sanction',SanctionController::class);


Route::patch('matches/{game}/programmer', [GameController::class, 'ProgrammerGame']);





Route::prefix('buteurs')->group(function () {
    Route::get('/', [ButeurController::class, 'index']);
    Route::get('/{id}', [ButeurController::class, 'show']);
    Route::post('/', [ButeurController::class, 'store']);
    Route::put('/{id}', [ButeurController::class, 'update']);
    Route::delete('/{id}', [ButeurController::class, 'destroy']);
});

Route::prefix('rapports')->group(function () {
    Route::get('/', [RapportController::class, 'index']);
    Route::get('/{id}', [RapportController::class, 'show']);
    Route::post('/', [RapportController::class, 'store']);
    Route::put('/{id}', [RapportController::class, 'update']);
    Route::delete('/{id}', [RapportController::class, 'destroy']);
});



Route::get('blessures', [BlessureController::class, 'index']);
Route::post('blessures', [BlessureController::class, 'store']);
Route::get('blessures/{id}', [BlessureController::class, 'show']);
Route::put('blessures/{id}', [BlessureController::class, 'update']);
Route::delete('blessures/{id}', [BlessureController::class, 'destroy']);



Route::apiResource('compositions', CompositionController::class);
