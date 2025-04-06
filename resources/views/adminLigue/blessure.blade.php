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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Équipe</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" id="injuriesTableBody">
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="font-medium">John Doe</div>
                    </td>
                    <td class="px-6 py-4">FC Lyon</td>
                    <td class="px-6 py-4">Entorse</td>
                    <td class="px-6 py-4">10/04/2025</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">En traitement</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button onclick="" class="text-blue-600 hover:text-blue-800">
                            Voir détails
                        </button>
                    </td>
                </tr>
                
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="font-medium">Alice Dupont</div>
                    </td>
                    <td class="px-6 py-4">Paris SG</td>
                    <td class="px-6 py-4">Fracture</td>
                    <td class="px-6 py-4">05/04/2025</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">En rééducation</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button onclick="" class="text-blue-600 hover:text-blue-800">
                            Voir détails
                        </button>
                    </td>
                </tr>
                
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="font-medium">Marc Lefevre</div>
                    </td>
                    <td class="px-6 py-4">AS Monaco</td>
                    <td class="px-6 py-4">Entorse</td>
                    <td class="px-6 py-4">02/04/2025</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Rétabli</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button onclick="" class="text-blue-600 hover:text-blue-800">
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


</div>
</div>



@endsection