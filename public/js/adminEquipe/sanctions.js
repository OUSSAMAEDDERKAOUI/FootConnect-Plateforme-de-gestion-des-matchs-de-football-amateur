const token = Cookies.get('Access-Token');

document.addEventListener('DOMContentLoaded', async () => {
     


    if (!token || token.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Session expirée',
            text: 'Vous allez être redirigé vers la page de connexion.',
            confirmButtonText: 'OK',
        }).then(() => {
            window.location.href = '/auth/login';
        });
        return;
    }

    fetchSanctions(1); 
    chargerStatistiquesSanctions();

})



    async function fetchSanctions(page) {
        try {
            let equipeId = Cookies.get('equipe_id');
            console.log(equipeId);
            const response = await fetch(`http://127.0.0.1:8000/api/equipe/${equipeId}/sanctions?page=${page}`,{
              method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,  
                    'Accept': 'application/json',  
                }
            }); 
            const data = await response.json();

            if (data.status === "success" && data.sanctions) {
                const tbody = document.getElementById("sanctionsTableBody");
                tbody.innerHTML = ""; 

                data.sanctions.data.forEach((sanction) => {
                    const tr = document.createElement("tr");

                    tr.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap">
                                     <div class="flex items-center">
 
              <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                            <img src="${sanction.joueur.user.photo}" class="h-full w-full object-cover rounded-full" alt="${sanction.joueur.user}"/>
            </div>
                                    <span class="font-medium">${sanction.joueur.user.nom} ${sanction.joueur.user.prenom}</span>

</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            ${sanction.type}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"> ${sanction.duree}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">${sanction.note ? sanction.note : 'Sans commentaire'}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                           ${sanction.joueur.statut}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900 mr-3" onclick="viewSanction(${sanction.id})">Voir détails</button>
                        </td>
                    `;

                    tbody.appendChild(tr);
                });


                window.renderSimplePagination(data.sanctions, fetchSanctions, '#sanctionsPaginationBody', 'pagination-games');

            } else {
                console.error("Erreur dans la réponse :", data.message);
            }
        } catch (error) {
            console.error("Erreur lors du fetch :", error);
        }
    }

    // document.addEventListener("DOMContentLoaded", fetchSanctions);









    async function viewSanction(sanctionId) {
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/equipe/sanction/${sanctionId}`,{
          method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,  
                    'Accept': 'application/json',  
                }
        });
        const SanctionData = await response.json();
        console.log('ID SANCTION :', sanctionId);
        console.log('Réponse :', SanctionData);

        const sanctionPopup = document.getElementById('sanctionContent');
        sanctionPopup.innerHTML = '';
        const sanction = SanctionData.sanctions[0]; 
        const joueur = sanction?.joueur || [];
        const user = joueur?.user || [];
        const equipe = joueur?.equipe || [];
        const game = sanction?.game || [];

        const homeTeam = game?.equipe_domicile || [];
        const awayTeam = game?.equipe_exterieur || [];

        const sanctionModal = document.createElement('div');

        let statusClass = '';
        let cacheUpdateButton = '';
        let cacheDeleteButton = '';

        if (sanction.type === 'Carton Rouge') {
            statusClass = 'red-card bg-red-100 text-red-800';
            cacheDeleteButton = 'hidden';
        } else if (sanction.type === 'Carton Jaune') {
            statusClass = 'yellow-card bg-yellow-100 text-yellow-800';
            cacheUpdateButton = 'hidden';
        } else if (sanction.type === 'Suspension') {
            statusClass = 'gray-card bg-gray-400 text-gray-800';
            cacheUpdateButton = 'hidden';
        }
               
        sanctionModal.innerHTML = `
      <div class="popup-card rounded-lg overflow-hidden w-full max-w-md mx-4 card-shadow">
        <!-- Image d'arrière-plan de terrain de football -->
        <div class="soccer-field-overlay"></div>
        
        <div id="sanctionHeader" class= " p-4 flex justify-between items-center relative z-10  ${statusClass}">
          <h2 id="sanctionType" class="text-white font-bold text-xl">${sanction.type}</h2>
          <button id="closePopup" onClick="closeModal()"class="text-white hover:text-gray-200 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        
        <div class="content-wrapper p-6 relative z-10">
          <div class="flex items-center mb-6">
            <!-- Photo du joueur -->
            <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-gray-200 mr-4 shadow-lg">
              <img id="playerPhoto" src="${sanction.joueur.user.photo}"alt="Photo du joueur" class="w-full h-full object-cover" />
            </div>
            
            <div>
              <h3 id="playerName" class="font-bold text-xl text-gray-800">${user.prenom} ${user.nom}</h3>
              <div class="flex items-center mt-1">
                <!-- Logo de l'équipe -->
                <div class="team-badge mr-2">
                  <img id="teamLogo" src="/storage/${equipe.logo}" alt="Logo équipe" class="w-full h-full object-cover rounded-full" />
                </div>
                <p id="teamName" class="text-gray-600">${equipe.nom}</p>
              </div>
              <div class="flex items-center mt-1">
                <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-1"></span>
                <span id="playerPosition" class="text-sm text-gray-500">${joueur.position}</span>
              </div>
            </div>
            
            <div class="ml-auto">
              <div id="sanctionIcon" class="w-12 h-16 ${statusClass} rounded shadow-md flex items-center justify-center">
              </div>
            </div>
          </div>
          
          <div class="bg-white bg-opacity-70 p-4 rounded-lg shadow">
            <div class="flex justify-between mb-2">
              <span class="text-gray-600">Match:</span>
              <div class="flex items-center">
                <div class="team-badge ">
                </div>
                <span id="matchTeams" class="font-medium ">${homeTeam.nom} vs ${awayTeam.nom}</span>
              </div>
            </div>
            <div class="flex justify-between mb-2">
              <span class="text-gray-600">Date:</span>
              <span id="sanctionDate" class="font-medium">${formatDate(game.date_heure)}</span>
            </div>
            <div class="flex justify-between mb-2">
              <span class="text-gray-600">Durée:</span>
              <span id="sanctionDuration" class="font-medium">${sanction.duree} match(s)</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Motif:</span>
              <span id="sanctionNote" class="font-medium">${sanction.note}</span>
            </div>
          </div>
          
          <div class="mt-4 p-3 bg-white bg-opacity-80 rounded-lg shadow">
            <h4 class="font-semibold text-blue-800 mb-2">Statut actuel du joueur</h4>
            <div class="flex items-center justify-center">
              <span id="playerStatus" class="px-3 py-1 bg-gray-100 text-gray-800 font-medium rounded-full">
                ${joueur.statut}
              </span>
            </div>
          </div>
          </div>
        </div>
      </div>
        `;

        sanctionPopup.appendChild(sanctionModal);
        document.getElementById('sanctionContent').classList.remove('hidden');

    } catch (error) {
        console.error('Erreur lors de la récupération des joueurs:', error);
    }
}







async function chargerStatistiquesSanctions() {
    try {
        const equipeId = Cookies.get('equipe_id');
        const response = await fetch(`http://127.0.0.1:8000/api/sanctions/equipe/${equipeId}/statistiques`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        });

        const stats = await response.json();
        document.getElementById('carte_jaune').textContent = stats.Carton_Jaune ?? 0;
        document.getElementById('suspensions').textContent = stats.Suspension ?? 0;
        document.getElementById('Avertissements').textContent = stats.avertissements ?? 0;
        document.getElementById('carte_rouge').textContent = stats.Carton_Rouge ?? 0;

    } catch (error) {
        console.error('Erreur lors du chargement des statistiques :', error);
    }
}




function closeModal() {
    const modal = document.getElementById('sanctionContent');
    if (modal) {
        modal.classList.add('hidden');
    }
}
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString('fr-FR', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit'
    });
}