<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\GameImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/login',function(){
    return view('/auth/login');
})->name('login');




Route::get('/listes/joueurs', function () {
    return view('adminLigue/listeJoueur');
});
Route::get('/ligue/sanction', function () {
    return view('adminLigue/sanction');
});
Route::get('/medecin/blessures', function () {
    return view('medecin/blessures');
});
Route::get('/ligue/matchs', function () {
    return view('adminLigue/matchs');
});

Route::get('/equipe/sanctions', function () {
    return view('adminEquipe/sanction');
});

Route::get('/equipe/liste/joueurs', function () {
    return view('adminEquipe/listesJoueur');
});

Route::get('/medecin/sanctions', function () {
    return view('medecin/sanctions');
});

Route::get('/medecin/liste/joueurs', function () {
    return view('medecin/listesJoueur');
});


Route::get('/equipe/matchs', function () {
    return view('adminEquipe/matchs');
});
Route::get('/medecin/matchs', function () {
    return view('medecin/matchs');
});

// Route::middleware(['auth', 'role:adminEquipe'])->group(function () {
    Route::get('/import/players', [ImportController::class, 'showImportForm'])->name('players.import.form');
    Route::post('/import-players', [ImportController::class, 'import'])->name('players.import');
    Route::get('/download-players-template', [ImportController::class, 'downloadTemplate'])->name('players.template.download');
// });

// Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/import/games', [GameImportController::class, 'showImportForm'])->name('games.import.form');
    Route::post('/import-games', [GameImportController::class, 'import'])->name('games.import');
    Route::get('/download-games-template', [GameImportController::class, 'downloadTemplate'])->name('games.template.download');
// });