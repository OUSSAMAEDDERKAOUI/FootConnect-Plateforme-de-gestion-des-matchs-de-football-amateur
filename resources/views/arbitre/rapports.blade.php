@extends('layouts/arbitre')
@section("title","Rapports de Matchs")
@section('style')
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .match-card {
            background-color: #f0f0f0;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .btn-blue {
            background-color: #1a5fa2;
            color: white;
            padding: 4px 16px;
            border-radius: 4px;
            font-weight: 500;
        }
        .custom-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }
        .team-icon {
            background-color: #4a88c7;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    @endsection
@section('content')
<header class="bg-white shadow fixed w-full z-50  ">
    <div class="px-6 py-4 ">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">📄 Gestion des rapports de match</h2>
            <button onclick="logout()"  class="block py-2.5 px-4 bg-blue-600 rounded transition duration-200 hover:bg-blue-700 ">Déconnexion    </button>

        </div>
    </div>
</header>
<div class="p-4 mt-16">
    <div class="w-[85%] mx-auto bg-white p-6 rounded-lg shadow">
        <div class="flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h1 class="font-bold text-lg">Rapports de match récents</h1>
        </div>

        <form id="rapportForm">
            <div class="mb-6">
                <div class="mb-4">
                    <p class="text-sm mb-1">Match</p>
                    <select id="matchSelect" name="game_id" class="w-full border rounded p-2 text-sm" required>
                        <option value="">-- Sélectionnez un match --</option>
                    </select>
                </div>
        
               
        
        
        <h2 class="font-bold text-md mb-3">Événements de match</h2>
        
        <div class="grid grid-cols-2 gap-4">
            <div class="match-card p-3">
                <div class="flex items-center gap-2 mb-2">
                    <div class="team-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium">FC Barcelone Amateur - Buts</span>
                </div>
                <div class="flex gap-2">
                    <select id="teamHomeGoal" class="custom-select border rounded p-2 text-sm flex-grow">
                        <option>sélectionner un joueur</option>
                    </select>
                    <input type="text" placeholder="Min" class="border rounded p-2 text-sm w-16">
                    <button class="btn-blue">Ajouter</button>
                </div>
            </div>

            <div class="match-card p-3">
                <div class="flex items-center gap-2 mb-2">
                    <div class="team-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium">Real Madrid Youth - Buts</span>
                </div>
                <div class="flex gap-2">
                    <select id="teamAwayGoal" class="custom-select border rounded p-2 text-sm flex-grow">
                        <option>sélectionner un joueur</option>
                    </select>
                    <input type="text" placeholder="Min" class="border rounded p-2 text-sm w-16">
                    <button class="btn-blue">Ajouter</button>
                </div>
            </div>

            <div class="match-card p-3">
                <div class="flex items-center gap-2 mb-2">
                    <div class="team-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium">FC Barcelone Amateur - Cartes</span>
                </div>
                <div class="flex gap-2">
                    <select id="teamHomeSanction" class="custom-select border rounded p-2 text-sm flex-grow">
                        <option>sélectionner un joueur</option>
                    </select>
                    <select id="teamHomeCarton" class="custom-select border rounded p-2 text-sm w-16">
                        <option value="Carton Jaune">J</option>
                        <option value="Carton Rouge">R</option>
                    </select>
                    <input type="text" placeholder="Min" class="border rounded p-2 text-sm w-16">
                    <button class="btn-blue">Ajouter</button>
                </div>
            </div>

            <div class="match-card p-3">
                <div class="flex items-center gap-2 mb-2">
                    <div class="team-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium">Real Madrid Youth - Buts</span>
                </div>
                <div class="flex gap-2">
                    <select  id="teamAwaySanction" class="custom-select border rounded p-2 text-sm flex-grow">
                        <option>sélectionner un joueur</option>
                    </select>
                    <select id="teamAwayCarton" class="custom-select border rounded p-2 text-sm w-16">
                        <option value="Carton Jaune">J</option>
                        <option value="Carton Rouge">R</option> 
                    </select>
                    <input type="text" placeholder="Min" class="border rounded p-2 text-sm w-16">
                    <button class="btn-blue">Ajouter</button>
                </div>
            </div>

            <div class="match-card p-3">
                <div class="flex items-center gap-2 mb-2">
                    <div class="team-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium">FC Barcelone Amateur - Substitution</span>
                </div>
                <div class=" teamHomeChanges flex gap-2">
                    <select id="teamHomeChangesIn" class="custom-select border rounded p-2 text-sm w-[40%]">
                        <option>sélectionner l'entré</option>
                    </select>
                    <select id="teamHomeChangesOut" class="custom-select border rounded p-2 text-sm w-[40%]">
                        <option>sélectionner la sortie</option>
                    </select>
                    <input type="text" placeholder="Min" class="border rounded p-2 text-sm w-16">
                    <button class="btn-blue">Ajouter</button>
                </div>
            </div>

            <div class="match-card p-3">
                <div class="flex items-center gap-2 mb-2">
                    <div class="team-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium">Real Madrid Youth - Substitution</span>
                </div>
                <div class="flex gap-2">
                    <select id="teamAwayChangesIn" class="custom-select border rounded p-2 text-sm w-[40%]">
                        <option>sélectionner l'entré</option>
                    </select>
                    <select id="teamAwayChangesOut" class="custom-select border rounded p-2 text-sm w-[40%]">
                        <option>sélectionner la sortie</option>
                    </select>
                    <input type="text" placeholder="Min" class="border rounded p-2 text-sm w-16">
                    <button class="btn-blue">Ajouter</button>
                </div>
            </div>
        </div>
        <div class="flex items-end justify-between gap-4">
            <div class="flex-1">
                <p class="text-sm mb-1">Score Domicile</p>
                <input type="number" min="0" name="score_domicile" class="w-full border rounded p-2 text-sm" placeholder="0" required>
            </div>

            <div class="flex items-end justify-center">
                <span class="mb-2 text-sm">vs</span>
            </div>

            <div class="flex-1">
                <p class="text-sm mb-1 invisible">label</p>
                <input type="number" min="0" name="score_exterieur" class="w-full border rounded p-2 text-sm" placeholder="0" required>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <h2 class="font-bold text-md mb-3">Réserves</h2>
        <textarea name="reserves" class="border rounded p-2 text-sm w-full" rows="3" placeholder="Entrez des réserves..."></textarea>
    </div>

    <div class="mt-6">
        <h2 class="font-bold text-md mb-3">Notes Supplémentaires</h2>
        <textarea name="notes" class="border rounded p-2 text-sm w-full" rows="3" placeholder="Entrez des notes supplémentaires sur le match..."></textarea>
    </div>

    {{-- <div class="flex items-start m-6">
        <button type="submit" class="btn-blue">Ajouter</button>
    </div> --}}
    <div class="mt-6 flex justify-center">
        <button type="submit" class="bg-blue-800 text-white py-2 px-4 rounded-md font-medium flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Ajouter Et Télécharger le rapport
        </button>
    </div>
</form>
        

      
    </div>
</div>
   

<script src="{{asset("js/arbitre/rapports.js")}}"></script>


@endsection 