

 @extends('layouts/adminLigue')
 @section("title","listes des joueurs")
 @section('content')
 <main class="flex-1 overflow-x-hidden overflow-y-auto">
     <!-- Header -->
     <header class="bg-white shadow">
         <div class="px-4 py-4 md:px-6">
             <div class="flex flex-col md:flex-row md:justify-between md:items-center space-y-3 md:space-y-0">
                 <h2 class="text-xl font-semibold text-gray-800" id="mainTitle">Administration Fédération</h2>
                 <div class="flex space-x-2">
                     <button id="btnExport"
                         class="bg-green-600 text-white px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-green-700 text-sm md:text-base">
                         Exporter
                     </button>
                     <button id="btnAction"
                         class="bg-blue-600 text-white px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 text-sm md:text-base">
                         Nouvelle Action
                     </button>
                 </div>
             </div>
         </div>
     </header>
 
     <div class="p-4 md:p-6">
         <div id="playerListsSection" class="section">
             <div class="bg-white rounded-lg shadow mb-6">
                 <div class="p-4">
                     <div class="flex flex-col md:flex-row md:flex-wrap md:gap-4 space-y-3 md:space-y-0">
                         <div class="flex-1 min-w-[200px]">
                             <label class="block text-sm font-medium text-gray-700 mb-1">Équipe</label>
                             <select class="w-full border rounded-lg px-3 py-2" id="teamFilter">
                                 <option value="all">Toutes les équipes</option>
                             </select>
                         </div>
                         <div class="flex-1 min-w-[200px]">
                             <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                             <select class="w-full border rounded-lg px-3 py-2" id="statusFilter">
                                 <option value="all">Tous les statuts</option>
                                 <option value="pending">En attente</option>
                                 <option value="validated">Validé</option>
                                 <option value="rejected">Rejeté</option>
                             </select>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="bg-white rounded-lg shadow overflow-hidden">
                 <div class="overflow-x-auto">
                     <table class="min-w-full divide-y divide-gray-200">
                         <thead class="bg-gray-50">
                             <tr>
                                 <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Équipe</th>
                                 <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                 <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joueurs</th>
                                 <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                 <th class="px-4 md:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                             </tr>
                         </thead>
                         <div id="playerListsTable">
                            <tbody class="bg-white divide-y divide-gray-200" id="playerListsTableBody">
                                <!-- Data depuis JavaScript -->
                            </tbody>
                         </div>
                        
                     </table>
                 </div>
             </div>
         </div>
     </div>
     <div id="playersModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
         <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-hidden flex flex-col">
             <div class="bg-white px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                 <h2 class="text-xl font-semibold text-gray-800" id="modalTitle">Liste des joueurs</h2>
                 <button id="closeModal" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                     <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                     </svg>
                 </button>
             </div>
             
             <div class="overflow-auto flex-grow p-6" id="modalContent">
                 <table class="min-w-full divide-y divide-gray-200">
                     <thead class="bg-gray-50">
                         <tr>
                             <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Matricule</th>
                             <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                             <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prénom</th>
                             <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Numéro</th>
                             <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                             <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                         </tr>
                     </thead>
                     <div id="playersTable">

                     <tbody class="bg-white divide-y divide-gray-200" id="playersTableBody">
                         <!-- Les joueurs depuis js -->
                     </tbody>
                     </div>
                 </table>
             </div>
             
             <div class="bg-gray-50 px-6 py-3 flex justify-end gap-6">
                <button id="makeListTraité"   data-id-equipe="" class="bg-green-200 hover:bg-green-300 text-green-800 font-semibold py-2 px-4 rounded">
                    Traiter
                </button>

                 <button id="closeModalBtn" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
                     Fermer
                 </button>
               
             </div>
         </div>
     </div>
 </main>
<script src="{{asset("/js/adminLigue/listeJoueur.js")}}"></script>

 <script>
 
 </script>
 @endsection