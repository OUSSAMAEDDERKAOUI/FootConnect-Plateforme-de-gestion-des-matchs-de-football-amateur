
@extends('layouts/adminLigue')
@section("title","Gestion des Matchs")
@section('content')

<header class="bg-white shadow-sm rounded-lg mb-6">
    <div class="px-6 py-5">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Gestion des Matchs</h2>
            <button id="btnAddMatch" class="bg-indigo-600 text-white px-5 py-2.5 rounded-md hover:bg-indigo-700 transition-colors duration-200 flex items-center gap-2 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Ajouter un Match
            </button>
        </div>
    </div>
</header>

<div class="flex justify-center gap-4 mb-8">
    <button id="btnMatchProgrammé" class="bg-emerald-600 text-white px-5 py-3 rounded-md hover:bg-emerald-700 transition-colors duration-200 shadow-md flex items-center gap-2 font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
        </svg>
        Matchs Programmés
    </button>
    
    <button id="btnMatchNonProgrammé" class="bg-gray-600 text-white px-5 py-3 rounded-md hover:bg-gray-700 transition-colors duration-200 shadow-md flex items-center gap-2 font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
        </svg>
        Matchs Non Programmés
    </button>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-md mb-8 border border-gray-100">
        <div class="p-5">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Filtres</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Période</label>
                    <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                        <option value="all">Tous les matchs</option>
                        <option value="upcoming">À venir</option>
                        <option value="past">Passés</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                    <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                        <option value="all">Tous les statuts</option>
                        <option value="scheduled">Programmé</option>
                        <option value="in_progress">En cours</option>
                        <option value="completed">Terminé</option>
                        <option value="cancelled">Annulé</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lieu</label>
                    <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                        <option value="all">Tous les lieux</option>
                        <option value="home">Domicile</option>
                        <option value="away">Extérieur</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Table des matchs programmés -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100" id="tableMatchProgrammé">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date et Heure
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Équipes
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lieu
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Résultat
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="matchsProgrammeTable">

                    
                </tbody>
            </table>
            {{-- <div id="pagination" class="flex justify-center mt-4 space-x-2"></div> --}}

        </div>
       
        
    </div>

    <!-- Table des matchs non programmés -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 mt-8 hidden" id="tableMatchNonProgrammé">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Journée
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Équipe locale  
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Équipe visiteuse 
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <div id="MatchNonProgrammé">
                    <tbody class="bg-white divide-y divide-gray-200" id="tbodyMatchNonProgrammé">

                   
                    </tbody>
                </div>
               
            </table>
           
        </div>
        {{-- <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row items-center justify-between">
                <div class="text-sm text-gray-500 mb-4 sm:mb-0">
                    Affichage de 1 à 10 sur 25 matchs
                </div>
                <div class="flex space-x-1">
                    <button class="px-3 py-1 border rounded-md hover:bg-gray-50 transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button class="px-3 py-1 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors duration-150">1</button>
                    <button class="px-3 py-1 border rounded-md hover:bg-gray-50 transition-colors duration-150">2</button>
                    <button class="px-3 py-1 border rounded-md hover:bg-gray-50 transition-colors duration-150">3</button>
                    <button class="px-3 py-1 border rounded-md hover:bg-gray-50 transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<!-- Modal pour ajouter un match -->
<div id="modalAddMatch" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full mx-4 overflow-hidden">
        <div class="bg-indigo-600 px-6 py-4 flex justify-between items-center">
            <h3 class="text-xl font-semibold text-white">Ajouter un nouveau match</h3>
            <button id="closeAddMatchModal" class="text-white hover:text-indigo-200 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <!-- Corps du formulaire -->
        <div class="p-6">
            <form id="addMatchForm">
                <div class="mb-4">
                    <label for="journee" class="block text-sm font-medium text-gray-700 mb-1">Journée</label>
                    <select id="journee" name="journee" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                        <option value="">Sélectionner une journée</option>
                        @for ( $i=1 ; $i<=30;$i++)

                        <option value="{{ $i }}">Journée  {{ $i }}</option> 
                        @endfor
                    </select>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="equipeLocale" class="block text-sm font-medium text-gray-700 mb-1">Équipe locale</label>
                        <select id="equipeLocale" name="equipeLocale" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                            <option value="">Sélectionner l'équipe locale</option>
                          
                        </select>
                    </div>
                    <div>
                        <label for="equipeVisiteuse" class="block text-sm font-medium text-gray-700 mb-1">Équipe visiteuse</label>
                        <select id="equipeVisiteuse" name="equipeVisiteuse" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                            <option value="">Sélectionner l'équipe visiteuse</option>
                            
                        </select>
                    </div>
                </div>
                
                <div class="flex justify-end mt-6 gap-3">
                    <button type="button" id="cancelAddMatch" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors duration-200 font-medium">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors duration-200 font-medium flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Ajouter le match
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour programmer un match -->
<div id="modalProgrammerMatch" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50  flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full mx-4   overflow-hidden">
        <div class="bg-emerald-600 px-6 py-4 flex justify-between items-center">
            <h3 class="text-xl font-semibold text-white">Programmer un match</h3>
            <button id="closeProgrammerMatchModal" class="text-white hover:text-emerald-200 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="p-6  "  >
          <div id="modalInfo">
            {{-- injectée depuis js --}}
          </div>
            
          <form id="programmerMatchForm" class="overflow-y-auto max-h-[60vh]">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="dateMatch" class="block text-sm font-medium text-gray-700 mb-1">Date du match</label>
                    <input type="datetime-local" id="dateMatch" name="dateMatch" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
                </div>
                
            </div>
        
            <div class="mb-4">
                <label for="lieuMatch" class="block text-sm font-medium text-gray-700 mb-1">Lieu</label>
                <input type="text" id="lieuMatch" name="lieuMatch" placeholder="Exemple: Camp Nou, Barcelone" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
            </div>
        
            <div class="mb-4">
                <label for="statutMatch" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                <select id="statutMatch" name="statutMatch" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
                    <option value="programmé">Programmé</option>
                    <option value="annulé">Annulé</option>
                </select>
            </div>
        
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="arbitreCentral" class="block text-sm font-medium text-gray-700 mb-1">Arbitre central</label>
                    <select id="arbitreCentral" name="arbitre_central_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
                    </select>
                </div>
                <div>
                    <label for="assistant1" class="block text-sm font-medium text-gray-700 mb-1">Assistant 1</label>
                    <select id="assistant1" name="assistant_1_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
                    
                    </select>
                </div>
                <div>
                    <label for="assistant2" class="block text-sm font-medium text-gray-700 mb-1">Assistant 2</label>
                    <select id="assistant2" name="assistant_2_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">

                    </select>
                </div>
                <div>
                    <label for="delegue" class="block text-sm font-medium text-gray-700 mb-1">Délégué</label>
                    <select id="delegue" name="delegue_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
                  
                    </select>
                </div>
            </div>
        
        
            <div class="flex justify-end mt-6 gap-3">
                <button type="button" id="cancelProgrammerMatch" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors duration-200 font-medium">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700 transition-colors duration-200 font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    Programmer le match
                </button>
            </div>
        </form>
        
        </div> 
        
    </div>
</div>

<!-- Modal pour update un match -->
<div id="modalupdateMatch" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50  flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full mx-4   overflow-hidden">
        <div class="bg-emerald-600 px-6 py-4 flex justify-between items-center">
            <h3 class="text-xl font-semibold text-white">Programmer un match</h3>
            <button id="closemodalupdateMatch" class="text-white hover:text-emerald-200 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="p-6  "  >
            <form id="updateMatchForm" class="overflow-y-auto max-h-[60vh]">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                  <div>
                    <label for="dateMatch" class="block text-sm font-medium text-gray-700 mb-1">Date du match</label>
                    <input type="datetime-local" id="dateGame" name="dateGame" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
                  </div>
              
                  <div>
                    <label for="lieuMatch" class="block text-sm font-medium text-gray-700 mb-1">Lieu</label>
                    <input type="text" id="lieuGame" name="lieuGame" placeholder="Exemple: Stade Mohammed V" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
                  </div>
                </div>
              
                <div class="mb-4">
                  <label for="statutMatch" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                  <select id="statutGame" name="statutGame" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
                    <option value="programmé">Programmé</option>
                    <option value="en cours">En cours</option>
                    <option value="terminé">Terminé</option>
                    <option value="annulé">Annulé</option>
                  </select>
                </div>
              
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                  <div>
                    <label for="scoreDomicile" class="block text-sm font-medium text-gray-700 mb-1">Score Équipe Domicile</label>
                    <input type="number" min="0" id="scoreDomicile" name="score_domicile" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
                  </div>
                  <div>
                    <label for="scoreExterieur" class="block text-sm font-medium text-gray-700 mb-1">Score Équipe Extérieure</label>
                    <input type="number" min="0" id="scoreExterieur" name="score_exterieur" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
                  </div>
                </div>
              
              

                <div class="flex justify-end mt-6 gap-3">
                  <button type="button" id="cancelUpdateMatch" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors duration-200 font-medium">
                    Annuler
                  </button>
                  <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700 transition-colors duration-200 font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    Mettre à jour le match
                  </button>
                </div>
              </form>
              
            
         
        
        </div> 
        
    </div>
</div>







<script src="{{asset('js/adminLigue/matchs.js')}}"></script>

    <script>

</script>

@endsection