@extends('layouts/adminLigue')
@section("title","listes des joueurs")
@section('content')
<header class="bg-white shadow">
    <div class="px-6 py-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Suivi des Blessures</h2>
            <button id="btnAddInjury" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Nouvelle Blessure
            </button>
        </div>
    </div>
</header>

<div class="p-6">

    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-4">
            <div class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Équipe</label>
                    <select class="w-full border rounded-lg px-3 py-2" id="teamFilter">
                        <option value="all">Toutes les équipes</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Type de Blessure</label>
                    <select class="w-full border rounded-lg px-3 py-2" id="injuryTypeFilter">
                        <option value="all">Tous les types</option>
                        <option value="muscular">Musculaire</option>
                        <option value="articular">Articulaire</option>
                        <option value="bone">Osseuse</option>
                        <option value="other">Autre</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select class="w-full border rounded-lg px-3 py-2" id="statusFilter">
                        <option value="all">Tous les statuts</option>
                        <option value="treatment">En traitement</option>
                        <option value="rehabilitation">En rééducation</option>
                        <option value="recovered">Rétabli</option>
                    </select>
                </div>
            </div>
        </div>
    </div>


    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joueur</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Match</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de blessure</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de retour estimée</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" id="injuriesTableBody">
              
                
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="font-medium">Alice Dupont</div>
                    </td>
                    <td class="px-6 py-4">Paris SG</td>
                    <td class="px-6 py-4">Entorse</td>
                    <td class="px-6 py-4">05/04/2025</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1  text-xs font-semibold  text-black-800">Entorse du genou</span>
                    </td>
                    <td class="px-6 py-4">15/04/2025</td>

                    <td class="px-6 py-4 text-right">
                        <button onclick="showInjuryDetails(2)" class="text-blue-600 hover:text-blue-800">
                            Voir détails
                        </button>
                    </td>
                </tr>      
            </tbody>
        </table>
    </div>
</div>
</main>
</div>
<div id="injuryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50  overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-md bg-white">
    <div class="flex justify-between items-center pb-4 border-b">
        <h3 class="text-xl font-semibold">Détails de la Blessure</h3>
        <button class="modal-close text-gray-400 hover:text-gray-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <div class="mt-4" id="injuryModalContent">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-4">
                <div>
                    <h4 class="font-semibold text-gray-700">Informations du Joueur</h4>
                    <p><strong>Nom:</strong> John Doe</p>
                    <p><strong>Équipe:</strong> FC Lyon</p>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-700">Détails de la Blessure</h4>
                    <p><strong>Type:</strong> Entorse</p>
                    <p><strong>Description:</strong> Entorse de la cheville droite lors d'un entraînement.</p>
                    <p><strong>Date:</strong> 10/04/2025</p>
                    <p><strong>Durée estimée:</strong> 2 semaines</p>
                    <p><strong>Médecin:</strong> Dr. Pierre Martin</p>
                </div>
            </div>
            <div>
                <h4 class="font-semibold text-gray-700 mb-2">Suivi des Traitements</h4>
                <div class="space-y-2">
                    <div class="p-2 bg-gray-50 rounded">
                        <p class="text-sm font-medium">12/04/2025</p>
                        <p class="text-sm text-gray-600">Repos et application de glace.</p>
                    </div>
                    <div class="p-2 bg-gray-50 rounded">
                        <p class="text-sm font-medium">15/04/2025</p>
                        <p class="text-sm text-gray-600">Première séance de kinésithérapie.</p>
                    </div>
                    <div class="p-2 bg-gray-50 rounded">
                        <p class="text-sm font-medium">20/04/2025</p>
                        <p class="text-sm text-gray-600">Réévaluation et nouvelle séance de rééducation.</p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="mt-4 flex justify-end space-x-2">
        <button class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 modal-close">Fermer</button>
    </div>

</div>
</div>



@endsection