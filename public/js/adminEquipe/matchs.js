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


    await loadMatches(1);
    
    async function loadMatches(page) {
        try {
            let equipeId = Cookies.get('equipe_id');
            const response = await fetch(`/api/equipe/matchs/${equipeId}?page=${page}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,  
                    'Accept': 'application/json',  
                }
            });

            const data = await response.json();
            console.log(data);
            
            renderMatches(data.matchs.data);
            
            window.renderSimplePagination(data.matchs, loadMatches, 'table', 'pagination-matches');

            
        } catch (error) {
            console.error('Erreur lors de la récupération des matchs:', error);
        }
    }
    
    function renderMatches(matches) {
        const tbody = document.querySelector('tbody');
        tbody.innerHTML = ''; 
    
        matches.forEach(match => {
            let statusClass = '';
            let statusBgColor = '';
            let statusTextColor = '';
            
            switch(match.statut) {
                case 'à venir':
                    statusClass = 'bg-blue-100 text-blue-800';
                    break;
                case 'programmé':
                    statusClass = 'bg-purple-100 text-purple-800';
                    break;
                case 'en cours':
                    statusClass = 'bg-yellow-100 text-yellow-800';
                    break;
                case 'terminé':
                    statusClass = 'bg-green-100 text-green-800';
                    break;
                case 'annulé':
                    statusClass = 'bg-red-100 text-red-800';
                    break;
                default:
                    statusClass = 'bg-gray-100 text-gray-800';
            }
            const date = new Date(match.date_heure);
            const formattedDate = date.toLocaleString('fr-FR', {
              day: '2-digit',
              month: '2-digit',
              year: 'numeric',
              hour: '2-digit',
              minute: '2-digit'
            });
            
            const row = `
                <tr class="hover:bg-gray-50 transition-colors duration-150" data-id="${match.id}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${formattedDate}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <span class="font-medium">${match.equipe_domicile.nom}</span>
                            <span class="text-gray-500">vs</span>
                            <span class="font-medium">${match.equipe_exterieur.nom}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${match.lieu}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                            ${match.statut || 'Non défini'}
                        </span>
                    </td>
                    <td class="px-10 py-4 whitespace-nowrap">
                        ${match.score_domicile ?? ''} - ${match.score_exterieur ?? ''}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <div class="flex justify-end space-x-2">
                          
                            <button class="text-green-600 hover:text-green-900 ">
                                  <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
    
            tbody.insertAdjacentHTML('beforeend', row);
        });
    
        
    };
///////////////////////////////////////////////////







// [closemodalupdateMatch, cancelUpdateMatch].forEach(el => {
//     el.addEventListener('click', () => {
//         document.getElementById('modalupdateMatch').classList.add('hidden');
//         document.body.style.overflow = '';
//     });
// });

})






        
      






