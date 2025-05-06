
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



    const btnMatchNonProgrammé = document.getElementById('btnMatchNonProgrammé');
    const btnMatchProgrammé = document.getElementById('btnMatchProgrammé');
    const tableMatchProgrammé = document.getElementById('tableMatchProgrammé');
    const tableMatchNonProgrammé = document.getElementById('tableMatchNonProgrammé');
const closemodalupdateMatch=document.getElementById('closemodalupdateMatch');
const cancelUpdateMatch = document.getElementById('cancelUpdateMatch');

    btnMatchNonProgrammé.addEventListener('click', function() {
        tableMatchProgrammé.classList.add('hidden');
        tableMatchNonProgrammé.classList.remove('hidden');
        
        btnMatchProgrammé.classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
        btnMatchProgrammé.classList.add('bg-gray-600', 'hover:bg-gray-700');
        btnMatchNonProgrammé.classList.remove('bg-gray-600', 'hover:bg-gray-700');
        btnMatchNonProgrammé.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
    });

    btnMatchProgrammé.addEventListener('click', function() {
        tableMatchProgrammé.classList.remove('hidden');
        tableMatchNonProgrammé.classList.add('hidden');
        
        btnMatchNonProgrammé.classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
        btnMatchNonProgrammé.classList.add('bg-gray-600', 'hover:bg-gray-700');
        btnMatchProgrammé.classList.remove('bg-gray-600', 'hover:bg-gray-700');
        btnMatchProgrammé.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
    });

//

const btnAddMatch = document.getElementById('btnAddMatch');
    const modalAddMatch = document.getElementById('modalAddMatch');
    const closeAddMatchModal = document.getElementById('closeAddMatchModal');
    const cancelAddMatch = document.getElementById('cancelAddMatch');
    const addMatchForm = document.getElementById('addMatchForm');
    
    const modalProgrammerMatch = document.getElementById('modalProgrammerMatch');
    const closeProgrammerMatchModal = document.getElementById('closeProgrammerMatchModal');
    const cancelProgrammerMatch = document.getElementById('cancelProgrammerMatch');
    const programmerMatchForm = document.getElementById('programmerMatchForm');
    
    btnAddMatch.addEventListener('click', function() {
        modalAddMatch.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; 
    });
    
    [closeAddMatchModal, cancelAddMatch].forEach(el => {
        el.addEventListener('click', function() {
            modalAddMatch.classList.add('hidden');
            document.body.style.overflow = ''; 
        });
    });

    
    





       
    


// Récupérer les équipes à afficher dans le formulaire d'ajout de match

        const equipeLocaleSelect = document.getElementById('equipeLocale');
        const equipeVisiteuseSelect = document.getElementById('equipeVisiteuse');
    
        try {
            const response = await fetch('/api/equipes', {
                method:'GET',
                headers:{
                    'Accept': 'application/json',  
                    'Authorization':`Bearer ${token}`
                }
            });
            const equipes = await response.json();
    console.log(equipes);
    
            const populateSelect = (select, equipes) => {
                select.innerHTML = '<option value="">Sélectionner une équipe</option>';
                equipes.forEach(equipe => {
                    const option = document.createElement('option');
                    option.value = equipe.id;
                    option.textContent = equipe.nom;
                    select.appendChild(option);
                });
            };
    
            populateSelect(equipeLocaleSelect, equipes);
            populateSelect(equipeVisiteuseSelect, equipes);
    
            equipeLocaleSelect.addEventListener('change', () => {
                const localeId = equipeLocaleSelect.value;
                Array.from(equipeVisiteuseSelect.options).forEach(option => {
                    option.disabled = option.value === localeId && option.value !== "";
                });
            });
    
            equipeVisiteuseSelect.addEventListener('change', () => {
                const visiteuseId = equipeVisiteuseSelect.value;
                Array.from(equipeLocaleSelect.options).forEach(option => {
                    option.disabled = option.value === visiteuseId && option.value !== "";
                });
            });
    
        } catch (error) {
            console.error('Erreur lors du chargement des équipes :', error);
        }
    });
    




//L'ajout deds matchs non programmé


addMatchForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        
        const nombre_journée = document.getElementById('journee').value;
        const equipe_domicile_id = document.getElementById('equipeLocale').value;
        const equipe_exterieur_id = document.getElementById('equipeVisiteuse').value;
        // alert(equipe_exterieur_id);
    
        try {
        
            const response = await fetch('/api/match', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization':`Bearer ${token}`
                },
                body: JSON.stringify({   nombre_journée, equipe_domicile_id , equipe_exterieur_id })
            });
        
            const data = await response.json();
        // alert(data);
            if (response.ok) {
                alert('Match ajouté avec succès!');
                modalAddMatch.classList.add('hidden');
                document.body.style.overflow = '';
                addMatchForm.reset();
                // alert("L'ajout réussie !");
            } else {
                // alert(5);
        
                alert(data.message || "Échec de connexion");
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert("Une erreur s'est produite");
        }
        });
        




    
    
   
    // L'affichage des match  programmé


document.addEventListener('DOMContentLoaded', async function() {
    await loadMatches(1);
    
    async function loadMatches(page) {
        try {
            const response = await fetch(`/api/match?page=${page}`, {
                method:'GET',
                headers:{
                    'Accept': 'application/json',  
                    'Authorization':`Bearer ${token}`
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
                           <button class="text-indigo-600 hover:text-indigo-900 edit-button" data-id="${match.id}">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                      <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                  </svg>
                           </button>
                            <button class="text-red-600 hover:text-red-900 delete-button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
    
            tbody.insertAdjacentHTML('beforeend', row);
        });
    
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', async (event) => {
                const matchRow = event.target.closest('tr');
                const matchId = matchRow.getAttribute('data-id');
    
                try {
                    const response = await fetch(`/api/match/${matchId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${token}`,
                        },
                    });
    
                    if (!response.ok) {
                        throw new Error('Erreur lors de la suppression du match');
                    }
    
                    Swal.fire({
                        icon: 'success',
                        title: 'Match Supprimé',
                        text: 'Le match a été supprimé avec succès.',
                        confirmButtonText: 'OK',
                    }).then(() => {
                        matchRow.remove(); 
                    });

                    } catch (error) {
                    console.error('Erreur:', error);
                    alert('Erreur lors de la suppression du match');
                }
            });
        });
    }
    
    
    
///////////////////////////////////////////////////


let selectedMatchId = null;

document.addEventListener('click', async (e) => {
    const editBtn = e.target.closest('.edit-button');
    if (editBtn) {
        const matchRow = editBtn.closest('tr');
        selectedMatchId = matchRow.getAttribute('data-id');

        const date = matchRow.querySelector('td:nth-child(1)').innerText;
        const lieu = matchRow.querySelector('td:nth-child(3)').innerText.trim();
        const statut = matchRow.querySelector('td:nth-child(4) span').innerText.trim();
        const score = matchRow.querySelector('td:nth-child(5)').innerText.trim().split(' - ');
        const scoreDomicile = score[0] || '';
        const scoreExterieur = score[1] || '';
        

        document.getElementById('dateGame').value = new Date(date).toISOString().slice(0,16);
        document.getElementById('lieuGame').value = lieu;
        document.getElementById('statutGame').value = statut;
        document.getElementById('scoreDomicile').value = scoreDomicile;
        document.getElementById('scoreExterieur').value = scoreExterieur;

        document.getElementById('modalupdateMatch').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
});


document.getElementById('updateMatchForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const form = e.target;

    const data = {
        date_heure: form.dateGame.value,
        lieu: form.lieuGame.value,
        statut: form.statutGame.value,
        score_domicile: form.scoreDomicile.value || null,
        score_exterieur: form.scoreExterieur.value || null,
    };
    
    console.log(localStorage.getItem('token'));
    console.log(data);
    try {
        const res = await fetch(`http://127.0.0.1:8000/api/match/${selectedMatchId}/update/`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',  
                'Authorization': `Bearer ${token}`,
            },
            body: JSON.stringify(data),
        });

        if (!res.ok) throw new Error("Échec de la mise à jour");

        Swal.fire({
            icon: 'success',
            title: 'Match mis à jour',
            confirmButtonText: 'OK'
        });

        const updatedMatch = await res.json();
         await loadMatches(1); 
        
        document.getElementById('modalupdateMatch').classList.add('hidden');
        document.body.style.overflow = '';
    } catch (err) {
        console.error(err);
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: err.message
        });
    }
});



[closemodalupdateMatch, cancelUpdateMatch].forEach(el => {
    el.addEventListener('click', () => {
        document.getElementById('modalupdateMatch').classList.add('hidden');
        document.body.style.overflow = '';
    });
});



//L'affichage des match non programmées :




await loadGames(1);
    
async function loadGames(page) {
    try {
        const response = await fetch(`/api/games?page=${page}`, {
            method:'GET',
            headers:{
                'Accept': 'application/json',  
                'Authorization':`Bearer ${token}`
            }
        });

        const results = await response.json();
        console.log(results);
        
        renderGames(results.games.data);
        
        window.renderSimplePagination(results.games, loadGames, '#MatchNonProgrammé', 'pagination-games');
        
    } catch (error) {
        console.error('Erreur lors de la récupération des matchs:', error);
    }
}

function renderGames(games) {
    const tbody = document.querySelector('#tbodyMatchNonProgrammé');
    tbody.innerHTML = '';
    
    games.forEach(game => {
      
        
        const row = `
            <tr class="hover:bg-gray-50 transition-colors duration-150">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${game.nombre_journée}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                            <img src="/storage/${game.equipe_domicile.logo}" class="h-12 w-12 object-cover rounded-full" alt="${game.equipe_domicile.nom}"/>
                        </div>
                        <span class="font-medium">${game.equipe_domicile.nom}</span>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                            <img src="/storage/${game.equipe_exterieur.logo}" class="h-full w-full object-cover rounded-full" alt="${game.equipe_exterieur.nom}"/>
                        </div>
                        <span class="font-medium">${game.equipe_exterieur.nom}</span>
                    </div>
                </td>
              
                <td class="px-6 py-4 whitespace-nowrap text-right">
                    <button data-id='${game.id}' data-journée='${game.nombre_journée}' data-equipe_domicile='${game.equipe_domicile.nom}' data-equipe_exterieur='${game.equipe_exterieur.nom}'
                     class="btn-game inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                        </svg>
                        Programmer
                    </button>
                </td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', row);
    });
}



function ouvrirModalProgrammerMatch(idMatch, journee, equipeLocale, equipeVisiteuse) {

  
        document.getElementById('modalInfo').innerHTML = `
          <div class="mb-6 bg-indigo-50 p-4 rounded-lg">
                <h4 class="text-lg font-medium text-indigo-800 mb-2">Information du match</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Journée</p>
                        <p class="font-medium" id="infoJournee">${journee} </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Équipes</p>
                        <p class="font-medium" id="infoEquipes">${equipeLocale} vs ${equipeVisiteuse}</p>
                    </div>
                </div>
                <input id="gameId" value="${idMatch}" type="hidden"></input>
            </div>
            
        </div>
        `
    

    modalProgrammerMatch.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}


document.addEventListener('click', function(e) {
    if (e.target.closest('.btn-game')) {

        const id = e.target.dataset.id;
        const equipe_domicile = e.target.dataset.equipe_domicile;
        const equipe_exterieur = e.target.dataset.equipe_exterieur;
        const journee = e.target.dataset.journée;

        ouvrirModalProgrammerMatch(id,journee,equipe_domicile , equipe_exterieur);

        modalProgrammerMatch.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    }
});

[closeProgrammerMatchModal, cancelProgrammerMatch].forEach(el => {
    el.addEventListener('click', function() {
        modalProgrammerMatch.classList.add('hidden');
        document.body.style.overflow = '';
    });
});


// Récupérer les arbitres et les delegues à afficher dans le formulaire de programmation  des matchs


    const arbitreSelect = document.getElementById('arbitreCentral');
    const assistant1Select = document.getElementById('assistant1');
    const assistant2Select = document.getElementById('assistant2');
    const delegueSelect = document.getElementById('delegue');
    
    try {
        const response = await fetch('/api/arbitre', {
            method:'GET',
            headers:{
                'Accept': 'application/json',  
                'Authorization':`Bearer ${token}`
            }
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const arbitres = await response.json();

        console.log('Arbitres chargés:', arbitres);
        
        const reponse = await fetch('/api/delegue', {
            method:'GET',
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'application/json',  
                'Authorization':`Bearer ${token}`
            }
        });
        
        if (!reponse.ok) {
            throw new Error(`HTTP error! status: ${reponse.status}`);
        }
        
        const delegues = await reponse.json();

        console.log('Délégués chargés:', delegues);
        
        const populateSelect = (select, personnes) => {
            select.innerHTML = '<option value="">Sélectionner </option>';
            
            personnes.forEach(personne => {  
                const option = document.createElement('option');
                option.value = personne.id;
                option.textContent = personne.user.nom;
                select.appendChild(option);
            });
        };
        
        populateSelect(arbitreSelect, arbitres);
        populateSelect(assistant1Select, arbitres);
        populateSelect(assistant2Select, arbitres);
        populateSelect(delegueSelect, delegues);
        
        const updateDisabledOptions = () => {
            const selectedArbitreValues = [
                arbitreSelect.value,
                assistant1Select.value,
                assistant2Select.value
            ].filter(value => value !== ""); 
            
            const arbitreSelects = [arbitreSelect, assistant1Select, assistant2Select];
            
            arbitreSelects.forEach(select => {
                const currentValue = select.value;
                
                Array.from(select.options).forEach(option => {
                    if (option.value === "") return; 
                    
                    option.disabled = 
                        option.value !== currentValue && 
                        selectedArbitreValues.includes(option.value);
                });
            });
            
        };
        
        const handleSelectChange = () => {
            updateDisabledOptions();
        };
        
        arbitreSelect.addEventListener('change', handleSelectChange);
        assistant1Select.addEventListener('change', handleSelectChange);
        assistant2Select.addEventListener('change', handleSelectChange);
        
        updateDisabledOptions();
        
    } catch (error) {
        console.error('Erreur lors du chargement des données:', error);
        
        [arbitreSelect, assistant1Select, assistant2Select, delegueSelect].forEach(select => {
            select.innerHTML = '<option value="">Erreur de chargement des données</option>';
            select.disabled = true;
        });
    }

});


programmerMatchForm.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const dateMatch = document.getElementById('dateMatch').value;
    const lieuMatch = document.getElementById('lieuMatch').value;
    const statutMatch = document.getElementById('statutMatch').value;
    const arbitreCentralId = document.getElementById('arbitreCentral').value;
    const assistant1Id = document.getElementById('assistant1').value;
    const assistant2Id = document.getElementById('assistant2').value;
    const delegueId = document.getElementById('delegue').value;
    const gameId = document.getElementById('gameId').value;

    // alert(gameId);

  
    
    try {
        const response = await fetch(`/api/matches/${gameId}/programmer`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization':`Bearer ${token}`

            },
            body: JSON.stringify({
                nombre_journée:gameId,
                date_heure: dateMatch,
                lieu: lieuMatch,
                statut: statutMatch,
                arbitre_central_id: arbitreCentralId,
                assistant_1_id: assistant1Id,
                assistant_2_id: assistant2Id,
                delegue_id: delegueId
            })
        });

        const data = await response.json();
        
        if (response.ok) {
            // alert('Match programmé avec succès!');
            modalProgrammerMatch.classList.add('hidden');
            document.body.style.overflow = '';
            programmerMatchForm.reset();
        } else {
            alert(data.message || "Échec de la programmation du match");
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert("Une erreur s'est produite lors de la programmation du match");
    }
});




