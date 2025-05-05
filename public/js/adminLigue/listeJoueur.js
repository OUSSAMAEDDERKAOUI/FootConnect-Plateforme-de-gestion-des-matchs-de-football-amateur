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

    fetchPlayerLists(1); 

})


async function fetchPlayerLists(page) {
    const teamFilter = document.getElementById('teamFilter').value;
    const statusFilter = document.getElementById('statusFilter').value;
    try {
        

        const response = await fetch(`/api/equipe/liste?page=${page}`,{
            method:'GET',
            headers:{
                'Accept': 'application/json',  
                'Authorization':`Bearer ${token}`
            }
        });
        const data = await response.json();
        renderListes(data)
        window.renderSimplePagination(data.equipes, fetchPlayerLists, '#playerListsTable', 'pagination-games');

    } catch (error) {
        console.error('Erreur lors du chargement des équipes :', error);
    }
}




 async function renderListes(listes){

    const tableBody = document.getElementById('playerListsTableBody');
    tableBody.innerHTML = ''; 

    listes.equipes.data.forEach(item => {
        const row = document.createElement('tr');

        let statusClass = '';
        if (item.statut === 'validé') statusClass = 'bg-green-100 text-green-800';
        else if (item.statut === 'En attente') statusClass = 'bg-yellow-100 text-yellow-800';
        else statusClass = 'bg-gray-100 text-gray-800';

        row.innerHTML = `
         <td class="px-4 md:px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
 
              <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                            <img src="/storage/${item.logo}" class="h-6 w-6 object-contain" alt="${item.logo}"/>
            </div>
                                    <span class="font-medium">${item.nom}</span>

</div>
     </td>      
           
            <td class="px-4 md:px-6 py-4 whitespace-nowrap">${formatDate(item.created_at)}</td>
            <td class="px-4 md:px-6 py-4 whitespace-nowrap">${item.joueurs_count || 0}</td>
            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                    ${item.statut || 'N/A'}
                </span>
            </td>
            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button onclick="viewPlayers(${item.id})" class="text-blue-600 hover:text-blue-900 mr-2">
                    Voir les joueurs                      <i class="fas fa-edit"></i>

                </button>
              
            </td>
        `;
        tableBody.appendChild(row);
    });
 }
 async function viewPlayers(teamId) {
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/equipe/liste/${teamId}`,{
            method:'GET',
            headers:{
                'Accept': 'application/json',  
                'Authorization':`Bearer ${token}`
            }
        });
        const teamData = await response.json();
        console.log('ID Équipe :', teamId);
        console.log('Réponse :', teamData);

        const playersTableBody = document.getElementById('playersTableBody');
        playersTableBody.innerHTML = '';
        const equipe = teamData.list.data[0]; 
        const joueurs = equipe?.joueurs || [];

        if (joueurs.length > 0) {
            joueurs.forEach((player, index) => {
                const row = document.createElement('tr');

                let statusClass = '';
                let cacheValidateButton = '';
                let cacheRejectButton = '';

                if (player.validation_status === 'validé') {
                    statusClass = 'bg-green-100 text-green-800';
                    cacheValidateButton = 'hidden';
                } else if (player.validation_status === 'rejeté') {
                    statusClass = 'bg-red-100 text-red-800';
                    cacheRejectButton = 'hidden';
                } else if (player.validation_status === 'en attente') {
                    statusClass = 'bg-yellow-100 text-yellow-800';
                }
               

                const matricule = `${teamId}${index + 1000}`;

                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${matricule}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${player.user.nom}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${player.user.prenom}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${player.numeroMaillot || 'N/A'}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full ${statusClass}">
                            ${player.validation_status || 'En attente'}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button onclick="validatePlayer(${player.id})" class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded mr-2 ${cacheValidateButton}">
                            Valider
                        </button>
                        <button onclick="rejectPlayer(${player.id})" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded ${cacheRejectButton}">
                            Rejeter
                        </button>
                    </td>
                `;

                playersTableBody.appendChild(row);
            });
        } else {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                    Aucun joueur ajouté pour cette équipe.
                </td>
            `;
            playersTableBody.appendChild(row);
        }

        document.getElementById('makeListTraité').setAttribute('data-id-equipe', teamId);
        document.getElementById('playersModal').classList.remove('hidden');

    } catch (error) {
        console.error('Erreur lors de la récupération des joueurs:', error);
    }
}


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

// function exportData() {
//     const rows = document.querySelectorAll("#playerListsTableBody tr");
//     const data = Array.from(rows).map(row => {
//         const columns = row.querySelectorAll("td");
//         return Array.from(columns).map(col => col.textContent.trim());
//     });

//     // Création du CSV
//     let csvContent = "data:text/csv;charset=utf-8,";
//     data.forEach(rowArray => {
//         const row = rowArray.join(",");
//         csvContent += row + "\r\n";
//     });

//     const link = document.createElement('a');
//     link.href = encodeURI(csvContent);
//     link.download = "export_joueurs.csv";
//     link.click();
// }


document.getElementById('makeListTraité').addEventListener('click', function() {

    const equipeId = document.getElementById('makeListTraité').getAttribute('data-id-equipe');

    console.log("L'ID de l'équipe est :", equipeId);
    makeListTraité(equipeId);
});








async function validatePlayer(playerId) {
   console.log('Validation du joueur:', playerId);
   
   try {
       
       const response = await fetch(`http://127.0.0.1:8000/api/joueur/${playerId}/validate`, {
           method: 'PUT',
           headers:{
               'Accept': 'application/json',  
               'Content-Type': 'application/json',
               'Authorization':`Bearer ${token}`
           }
       });
       
       if (!response.ok) {
           throw new Error('La validation a échoué');
       }
       
       const data = await response.json();
       console.log('Joueur validé avec succès:', data);
       
     
       const clickedButton = document.querySelector(`button[onclick="validatePlayer(${playerId})"]`);
       if (clickedButton) {
           const row = clickedButton.closest('tr');
           if (row) {
               const statusCell = row.querySelector('td:nth-child(5) span');
               if (statusCell) {
                   statusCell.textContent = 'validé';
                   statusCell.className = 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800';
                   
                   const actionCell = row.querySelector('td:nth-child(6)');
                   if (actionCell) {
                       actionCell.innerHTML = '<span class="text-green-600">Joueur validé</span>';
                   }
               }
           }
       }
       
       alert('Le joueur a été validé avec succès');
       
   } catch (error) {
       console.error('Erreur lors de la validation du joueur:', error);
       alert('Erreur lors de la validation du joueur');
   }
}


 async function rejectPlayer(playerId) {
   console.log('rejection du joueur:', playerId);
   
   try {
     
       
       const response = await fetch(`http://127.0.0.1:8000/api/joueur/${playerId}/reject`, {
        method: 'PUT',
        headers:{
            'Accept': 'application/json',  
            'Content-Type': 'application/json',
            'Authorization':`Bearer ${token}`
        }
       });
       
       if (!response.ok) {
           throw new Error('La validation a échoué');
       }
       
       const data = await response.json();
       console.log('Joueur rejeté avec succès:', data);
       
       const clickedButton = document.querySelector(`button[onclick="rejectPlayer(${playerId})"]`);
       if (clickedButton) {
           const row = clickedButton.closest('tr');
           if (row) {
               const statusCell = row.querySelector('td:nth-child(5) span');
               if (statusCell) {
                   statusCell.textContent = 'rejeté';
                   statusCell.className = 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800';
                   
                   const actionCell = row.querySelector('td:nth-child(6)');
                   if (actionCell) {
                       actionCell.innerHTML = 'Joueur rejeté';
                   }
               }
           }
       }
       
       alert('Le joueur a été validé avec succès');
       
   } catch (error) {
       console.error('Erreur lors de la validation du joueur:', error);
       alert('Erreur lors de la validation du joueur');
   }
}




async function makeListTraité(equipeId) {
    console.log('Traitement de la liste équipe:', equipeId);
    
    try {
        
        const response = await fetch(`http://127.0.0.1:8000/api/equipe/${equipeId}/liste`, {
            method: 'PUT',
           headers:{
               'Accept': 'application/json',  
               'Content-Type': 'application/json',
               'Authorization':`Bearer ${token}`
           }
        });
        
        if (!response.ok) {
            throw new Error('Le traitement de la liste a échoué');
        }
        
        const data = await response.json();
        console.log('Liste marquée comme traitée avec succès:', data);
        
        document.getElementById('playersModal').classList.add('hidden');
        
        fetchPlayerLists(1);
        
        alert('La liste a été marquée comme traitée avec succès');
        
    } catch (error) {
        console.error('Erreur lors du traitement de la liste:', error);
        alert('Erreur lors du traitement de la liste');
    }
}






document.getElementById('closeModal').addEventListener('click', closeModal);
document.getElementById('closeModalBtn').addEventListener('click', closeModal);

// document.getElementById('btnExport').addEventListener('click', exportData);

