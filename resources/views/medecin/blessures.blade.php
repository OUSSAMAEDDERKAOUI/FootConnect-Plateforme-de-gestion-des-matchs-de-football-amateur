
@extends('layouts/Medecin')
@section("title","Les Blessures")
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut Actuel</th>
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

<div id="addInjuryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white overflow-y-auto">
        <div class="flex justify-between items-center pb-4 border-b">
            <h3 class="text-xl font-semibold" id="modalTitle">Ajouter une Blessure</h3>
            <button id="closeAddInjuryModal" class="modal-close text-gray-400 hover:text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="mt-4">
            <form id="injuryForm" class="space-y-4">
                <input type="hidden" id="injury_id" value="">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Joueur</label>
                    <select id="joueurSelect" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        <option value="">Chargement...</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Match</label>
                    <select id="matchSelect" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="">Chargement...</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Type de blessure</label>
                    <select id="type" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        <option value="musculaire">Musculaire</option>
                        <option value="articulaire">Articulaire</option>
                        <option value="osseuse">Osseuse</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" rows="3" class="w-full border border-gray-300 rounded px-3 py-2" required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Date de blessure</label>
                    <input type="date" id="date_blessure" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Date estimée de retour</label>
                    <input type="date" id="retour_estime" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="flex justify-end">
                    <button type="button" id="cancelAddInjury" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 mr-2">Annuler</button>
                    <button type="submit" id="submitBtn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter la blessure</button>
                </div>
            </form>

            <div id="successMessage" class="text-green-600 mt-4 hidden">Opération réussie !</div>
        </div>
    </div>
</div>

<div id="deleteConfirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-4 border-b">
            <h3 class="text-xl font-semibold text-red-600">Confirmer la suppression</h3>
            <button id="closeDeleteModal" class="text-gray-400 hover:text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="mt-4">
            <p class="text-gray-700">Êtes-vous sûr de vouloir supprimer cette blessure ? Cette action est irréversible.</p>
            <input type="hidden" id="deleteInjuryId" value="">
            <div class="mt-6 flex justify-end space-x-2">
                <button id="cancelDelete" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</button>
                <button id="confirmDelete" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Supprimer</button>
            </div>
        </div>
    </div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const token = localStorage.getItem('token');
            
        if (!token) {
            console.error('Token d\'authentification manquant');
            return;
        }

        fetchInjury();

        const joueurSelect = document.getElementById('joueurSelect');
        const matchSelect = document.getElementById('matchSelect');
        const form = document.getElementById('injuryForm');
        const btnAddInjury = document.getElementById('btnAddInjury');
        const addInjuryModal = document.getElementById('addInjuryModal');
        const closeAddInjuryModal = document.getElementById('closeAddInjuryModal');
        const cancelAddInjury = document.getElementById('cancelAddInjury');
        const modalTitle = document.getElementById('modalTitle');
        const submitBtn = document.getElementById('submitBtn');
        const injuryIdInput = document.getElementById('injury_id');
        
        const deleteConfirmModal = document.getElementById('deleteConfirmModal');
        const closeDeleteModal = document.getElementById('closeDeleteModal');
        const cancelDelete = document.getElementById('cancelDelete');
        const confirmDelete = document.getElementById('confirmDelete');
        const deleteInjuryId = document.getElementById('deleteInjuryId');

        btnAddInjury.addEventListener('click', () => {
            form.reset();
            injuryIdInput.value = '';
            modalTitle.textContent = 'Ajouter une Blessure';
            submitBtn.textContent = 'Ajouter la blessure';
            
            addInjuryModal.classList.remove('hidden');
            document.body.style.overflow = "hidden";
        });

        [closeAddInjuryModal, cancelAddInjury].forEach(el => {
            el.addEventListener('click', () => {
                addInjuryModal.classList.add('hidden');
                document.body.style.overflow = '';
            });
        });
        
        [closeDeleteModal, cancelDelete].forEach(el => {
            el.addEventListener('click', () => {
                deleteConfirmModal.classList.add('hidden');
                document.body.style.overflow = '';
            });
        });
        
        confirmDelete.addEventListener('click', async () => {
            const injuryId = deleteInjuryId.value;
            if (!injuryId) return;
            
            const response = await fetch(`http://127.0.0.1:8000/api/blessures/${injuryId}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            });
            
            if (response.ok) {
                deleteConfirmModal.classList.add('hidden');
                document.body.style.overflow = '';
                
                const successMsg = document.createElement('div');
                successMsg.className = 'fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded shadow-lg';
                successMsg.textContent = 'Blessure supprimée avec succès';
                document.body.appendChild(successMsg);
                
                setTimeout(() => {
                    successMsg.remove();
                }, 3000);
                
                fetchInjury(); 
            } else {
                const error = await response.json();
                alert('Erreur lors de la suppression: ' + JSON.stringify(error));
            }
        });

        const equipeRes = await fetch('http://127.0.0.1:8000/api/medecin/equipe', {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,  
                'Accept': 'application/json',  
            }
        });

        const medecinData = await equipeRes.json();
        console.log(medecinData); 

        const equipeId = medecinData.medecin.equipe_id;
        console.log(equipeId); 

        const joueursRes = await fetch(`http://127.0.0.1:8000/api/equipe/liste/${equipeId}`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });
        const joueursData = await joueursRes.json();
        data = joueursData.list.data[0];
        joueurs = data.joueurs;
        console.log(joueurs);
        joueurSelect.innerHTML = '<option value="">-- Sélectionner un joueur --</option>';
        joueurs.forEach(joueur => {
            const option = document.createElement('option');
            option.value = joueur.id;
            option.textContent = joueur.user.prenom + ' ' + joueur.user.nom;
            joueurSelect.appendChild(option);
        });

        const matchsRes = await fetch(`http://127.0.0.1:8000/api/equipe/${equipeId}/matchs`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });
        const matchData = await matchsRes.json();
        const matchs = matchData.matchs.data;
        console.log(matchData);

        matchSelect.innerHTML = '<option value="">-- Sélectionner un match --</option>';
        matchs.forEach(match => {
            const option = document.createElement('option');
            option.value = match.id;
            option.textContent = `${match.equipe_domicile.nom} vs ${match.equipe_exterieur.nom} - ${new Date(match.date_heure).toLocaleDateString()}`;
            matchSelect.appendChild(option);
        });

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const payload = {
                joueur_id: joueurSelect.value,
                type: document.getElementById('type').value,
                description: document.getElementById('description').value,
                date_blessure: document.getElementById('date_blessure').value,
                retour_estime: document.getElementById('retour_estime').value,
                game_id: matchSelect.value || null
            };
            
            const injuryId = injuryIdInput.value;
            let url = 'http://127.0.0.1:8000/api/blessures';
            let method = 'POST';
            
            if (injuryId) {
                url = `http://127.0.0.1:8000/api/blessures/${injuryId}`;
                method = 'PUT';
            }

            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify(payload)
            });

            if (response.ok) {
                form.reset();
                document.getElementById('successMessage').textContent = injuryId ? 'Blessure mise à jour avec succès !' : 'Blessure ajoutée avec succès !';
                document.getElementById('successMessage').classList.remove('hidden');
                setTimeout(() => {
                    document.getElementById('successMessage').classList.add('hidden');
                    addInjuryModal.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 2000);
                fetchInjury();
            } else {
                const error = await response.json();
                alert('Erreur: ' + JSON.stringify(error));
            }
        });
    });

    async function fetchInjury() {
        const token = localStorage.getItem('token');
        if (!token) {
            console.error('Token d\'authentification manquant');
            return;
        }
        
        const response = await fetch(`http://127.0.0.1:8000/api/blessures`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });
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
            const gameName = injury.game.equipe_domicile.nom +' VS '+ injury.game.equipe_exterieur.nom
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
                     <td class="px-6 py-4">
                       <span class="${injury.joueur.statut === 'blesse' ? 'text-red-600 font-semibold' : 'text-green-600 font-semibold'}">
                         ${injury.joueur.statut}
                       </span>
                     </td>
                <td class="px-6 py-4 text-right">
                <div class="flex justify-end space-x-2">
                    <button onclick="isHealthy(${injury.id})" class="text-blue-600 hover:text-blue-800">
             <i class="fas fa-check-circle text-green-500"> </i>   
                        </button>
                    <button onclick="showInjuryDetails(${injury.id})" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button onclick="editInjury(${injury.id})" class="text-yellow-600 hover:text-yellow-800">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="deleteInjury(${injury.id})" class="text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                </td>
            `;
            
            tableBody.appendChild(row);
        });
    }

    async function showInjuryDetails(injuryId) {
        const token = localStorage.getItem('token');
        if (!token) {
            console.error('Token d\'authentification manquant');
            return;
        }
        
        const modal = document.getElementById('injuryModal');
        const modalContent = document.getElementById('injuryModalContent');
        
        const response = await fetch(`http://127.0.0.1:8000/api/blessures/${injuryId}`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });
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
    
    async function isHealthy(id) {
        const token = localStorage.getItem('token');
        if (!token) {
            console.error('Token d\'authentification manquant');
            return null;
        }
        
        try {
            const response = await fetch(`/api/blessure/${id}/finished`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            });

            if (!response.ok) {
                throw new Error(`Erreur : ${response.status}`);
            }

            const data = await response.json();
            console.log(data);
            fetchInjury();

            return data;

        } catch (error) {
            console.error("Erreur lors de la vérification de l'état de santé :", error);
            return null;
        }
    }

    async function editInjury(injuryId) {
        const token = localStorage.getItem('token');
        if (!token) {
            console.error('Token d\'authentification manquant');
            return;
        }

        const response = await fetch(`http://127.0.0.1:8000/api/blessures/${injuryId}`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });
        const data = await response.json();
        
        document.getElementById('modalTitle').textContent = 'Modifier la Blessure';
        document.getElementById('submitBtn').textContent = 'Mettre à jour';
        
        document.getElementById('injury_id').value = injuryId;
        document.getElementById('joueurSelect').value = data.joueur.id;
        document.getElementById('type').value = data.type;
        document.getElementById('description').value = data.description;
        document.getElementById('date_blessure').value = data.date_blessure.split('T')[0]; 
        document.getElementById('retour_estime').value = data.retour_estime.split('T')[0]; 
        
        if (data.game && data.game.id) {
            document.getElementById('matchSelect').value = data.game.id;
        } else {
            document.getElementById('matchSelect').value = '';
        }
        
        document.getElementById('addInjuryModal').classList.remove('hidden');
        document.body.style.overflow = "hidden";
    }
    
    function deleteInjury(injuryId) {
        document.getElementById('deleteInjuryId').value = injuryId;
        
        document.getElementById('deleteConfirmModal').classList.remove('hidden');
        document.body.style.overflow = "hidden";
    }

    document.addEventListener('DOMContentLoaded', () => {
        const closebtn = document.getElementById('closebtn');
        const clsButton = document.getElementById('clsButton');
        
        [closebtn, clsButton].forEach(el => {
            el.addEventListener('click', () => {
                document.getElementById('injuryModal').classList.add("hidden");
                document.body.style.overflow = ''; 
            });
        });
    });
</script>
@endsection