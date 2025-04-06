@extends('layouts/adminLigue')
@section("title","Les sanctions")
@section('content')

<header class="bg-white shadow">
    <div class="px-6 py-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Gestion des Sanctions</h2>
            <button id="btnAddSanction" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Ajouter une Sanction
            </button>
        </div>
    </div>
</header>

<!-- Content -->
<div class="p-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Sanctions en Cours</h3>
                    <p class="text-2xl font-semibold">4</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Suspensions</h3>
                    <p class="text-2xl font-semibold">2</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Avertissements</h3>
                    <p class="text-2xl font-semibold">3</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Sanctions Terminées</h3>
                    <p class="text-2xl font-semibold">8</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et Recherche -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-4">
            <div class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Rechercher un joueur..." 
                               class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 text-gray-500 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <select class="w-full border rounded-lg px-3 py-2">
                        <option value="all">Type de sanction</option>
                        <option value="suspension">Suspension</option>
                        <option value="warning">Avertissement</option>
                        <option value="fine">Amende</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <select class="w-full border rounded-lg px-3 py-2">
                        <option value="all">Statut</option>
                        <option value="active">En cours</option>
                        <option value="completed">Terminée</option>
                        <option value="cancelled">Annulée</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <input type="date" class="w-full border rounded-lg px-3 py-2" placeholder="Date">
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des Sanctions -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Joueur
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type de Sanction
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Période
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Raison
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="sanctionsTableBody">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">sanction.playerName</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                           sanction.type
                            <div class="text-xs text-gray-500 mt-1">sanction.details</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">sanction.startDate</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">sanction.reason</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                           sanction.status
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900 mr-3" onclick="viewSanctionDetails($sanction.id)">Voir détails</button>
               
                        </td>
                    </tr>   
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">sanction.playerName</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                           sanction.type
                            <div class="text-xs text-gray-500 mt-1">sanction.details</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">sanction.startDate</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">sanction.reason</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                           sanction.status
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900 mr-3" onclick="viewSanctionDetails($sanction.id)">Voir détails</button>
               
                        </td>
                    </tr>    
                          </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Affichage de 1 à 10 sur 15 sanctions
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border rounded hover:bg-gray-50">Précédent</button>
                    <button class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">1</button>
                    <button class="px-3 py-1 border rounded hover:bg-gray-50">2</button>
                    <button class="px-3 py-1 border rounded hover:bg-gray-50">Suivant</button>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
</div>




@endsection