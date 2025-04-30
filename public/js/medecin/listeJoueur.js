document.addEventListener('DOMContentLoaded', async () => {
    const token = Cookies.get('Access-Token');
     


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

    fetchPlayerLists(1); 

})


async function fetchPlayerLists(page) {
    
    try {
        const token = localStorage.getItem('token');
            
        if (!token) {
            console.error('Token d\'authentification manquant');
            return;
        }
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

        const response = await fetch(`http://127.0.0.1:8000/api/equipe/${equipeId}/liste?page=${page}`);

        const data = await response.json();
        console.log('ID Équipe :', equipeId);
        console.log('Réponse :', data);
        renderListes(data)
        window.renderSimplePagination(data.list, fetchPlayerLists, '#playerListsTable', 'pagination-games');

    } catch (error) {
        console.error('Erreur lors du chargement des équipes :', error);
    }
}




 async function renderListes(listes){

    const tableBody = document.getElementById('playerListsTableBody');
    tableBody.innerHTML = ''; 
    const joueurs = listes.list?.data || [];
console.log(joueurs);
 if (joueurs.length > 0) {
            joueurs.forEach((player, index) => {        
                const row = document.createElement('tr');

        let statusClass = '';
        if (player.statut === 'validé') statusClass = 'bg-green-100 text-green-800';
        else if (player.statut === 'En attente') statusClass = 'bg-yellow-100 text-yellow-800';
        else statusClass = 'bg-gray-100 text-gray-800';

        row.innerHTML = `
         <td class="px-4 md:px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
 
          
            <span class="font-medium">${player.user.nom} ${player.user.prenom}</span>

</div>
     </td>      
           
            <td class="px-4 md:px-6 py-4 whitespace-nowrap">${player.user.date_naissance}</td>
            <td class="px-4 md:px-6 py-4 whitespace-nowrap">${player.numeroMaillot || 'N/A'}</td>
            <td class="px-4 md:px-6 py-4 whitespace-nowrap">${player.position || 'N/A'}</td>

            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                ${player.validation_status || 'En attente'}
                </span>
            </td>
            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button onclick="viewPlayers(${player.id})" class="text-blue-600 hover:text-blue-900 mr-2">
                    Voir Details   <i class="fas fa-eye"></i> 
                </button>
              
            </td>
        `;
        tableBody.appendChild(row);
    });
 }
}



async function viewPlayers(id) {
    try {
      const response = await fetch(`http://127.0.0.1:8000/api/joueur/${id}`);
      const data = await response.json();
  

      const player = data.player;
      const user = player.user;
      const equipe = player.equipe;

      document.getElementById('playerName').textContent = `${user.nom} ${user.prenom}`;
      document.getElementById('playerTeam').textContent = ` ${equipe.nom}`;
      document.getElementById('playerStatus').textContent = player.statut;
      document.getElementById('statusIndicator').className = `h-3 w-3 rounded-full ${player.statut === 'validé' ? 'bg-green-500' : 'bg-yellow-500'}`;
      document.getElementById('playerGoals').textContent = data.buts;
      document.getElementById('playerYellowCards').textContent = data.sanction;
      document.getElementById('playerRedCards').textContent = '0'; 
      document.getElementById('playerPosition').textContent = player.position;
      document.getElementById('playerBirthdate').textContent = user.date_naissance;
      document.getElementById('playerNumber').textContent = `Numéro: ${player.numeroMaillot}`;
  
      document.getElementById('offensiveEfficiency').textContent = '0%';
      document.getElementById('defensiveEfficiency').textContent = '0%';
      document.querySelector('.progress-bar-bg.bg-blue-500').style.width = '0%';
      document.querySelector('.progress-bar-bg.bg-green-500').style.width = '0%';
  
      document.querySelector('.player-photo').style.backgroundImage = `url('${user.photo}')`;
  
      document.getElementById('teamLogo').src=`${equipe.logo}`;
  
      document.getElementById('playerPopup').classList.add('active');
  
    } catch (error) {
      console.error("Erreur lors du chargement du joueur :", error);
      alert("Impossible de charger les informations du joueur.");
    }
  }
  
  document.getElementById('closePopup').addEventListener('click', () => {
    document.getElementById('playerPopup').classList.remove('active');
  });
  
  document.getElementById('closePopupBtn').addEventListener('click', () => {
    document.getElementById('playerPopup').classList.remove('active');
  });





function closeModal() {
    document.getElementById('playersModal').classList.add('hidden');
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














 









