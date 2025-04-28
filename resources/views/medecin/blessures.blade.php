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
            </tbody>
        </table>
    </div>
</div>

<div id="injuryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-md bg-white overflow-y-auto">
        <div class="flex justify-between items-center pb-4 border-b">
            <h3 class="text-xl font-semibold">Détails de la Blessure</h3>
            <button id="closebtn" class="modal-close text-gray-400 hover:text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="mt-4" id="injuryModalContent">
        </div>
        <div class="mt-4 flex justify-end space-x-2">
            <button id="clsButton" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 modal-close">Fermer</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    fetchInjury();
})

async function fetchInjury() {
    const response = await fetch(`http://127.0.0.1:8000/api/blessures`);
    const data = await response.json();
    renderListes(data);
}

function renderListes(data) {
    const tableBody = document.getElementById('injuriesTableBody');
    tableBody.innerHTML = ''; 

    data.forEach(injury => {
        const row = document.createElement('tr');
        row.classList.add('hover:bg-gray-50');
        
        const playerName = injury.joueur.user.prenom + ' ' + injury.joueur.user.nom;
        const gameName = injury.game.equipe_exterieur_id === injury.joueur.equipe_id ? "Équipe extérieure" : "Équipe domicile"; 
        const injuryDate = new Date(injury.date_blessure).toLocaleDateString();
        const injuryType = injury.type.charAt(0).toUpperCase() + injury.type.slice(1); 
        const description = injury.description;
        const estimatedReturnDate = new Date(injury.retour_estime).toLocaleDateString();

        row.innerHTML = `
            <td class="px-6 py-4">${playerName}</td>
            <td class="px-6 py-4">${gameName}</td>
            <td class="px-6 py-4">${injuryDate}</td>
            <td class="px-6 py-4">${injuryType}</td>
            <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold text-black-800">${description}</span></td>
            <td class="px-6 py-4">${estimatedReturnDate}</td>
            <td class="px-6 py-4 text-right">
            <button onclick="showInjuryDetails(${injury.id})" class="text-blue-600 hover:text-blue-800">
                 <i class="fas fa-eye"></i>
            </button>
            </td>
        `;
        
        tableBody.appendChild(row);
    });
}

async function showInjuryDetails(injuryId) {
    const modal = document.getElementById('injuryModal');
    const modalContent = document.getElementById('injuryModalContent');
    
    const response = await fetch(`http://127.0.0.1:8000/api/blessures/${injuryId}`);
    const data = await response.json();
    
    const player = data.joueur.user;
    const teamLogo = data.joueur.equipe.logo;
    const playerImage = player.photo; 

    modalContent.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    <img class="w-16 h-16 rounded-full object-cover" src="${playerImage}" alt="Player Image">
                    <div>
                        <h4 class="font-semibold text-gray-700">${player.prenom} ${player.nom}</h4>
                        <p class="text-sm text-gray-500">Équipe: ${data.joueur.equipe.nom}</p>
                    </div>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-700 mt-4">Détails de la Blessure</h4>
                    <p><strong>Type:</strong> ${data.type ? data.type : 'Non spécifié'}</p>
                    <p><strong>Description:</strong> ${data.description || 'Aucune description disponible.'}</p>
                    <p><strong>Date de blessure:</strong> ${new Date(data.date_blessure).toLocaleDateString()}</p>
                    <p><strong>Durée estimée de retour:</strong> ${new Date(data.retour_estime).toLocaleDateString()}</p>
                </div>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-700 mb-2">Suivi des Traitements</h4>
                <div class="space-y-2">
                    <p class="text-gray-500">Aucun traitement enregistré.</p>
                </div>
            </div>
        </div>
    `;

    modal.classList.remove('hidden');
    document.body.style.overflow = "hidden"; 
}

[closebtn, clsButton].forEach(el => {
    el.addEventListener('click', () => {
        document.getElementById('injuryModal').classList.add("hidden");
        document.body.style.overflow = ''; 
    });
});
</script>

@endsection
