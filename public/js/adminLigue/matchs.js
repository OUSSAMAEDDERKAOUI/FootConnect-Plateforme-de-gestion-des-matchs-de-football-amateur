// gestion d'affichage des listes des matchs programmés ou non 

document.addEventListener('DOMContentLoaded', async () => {
    const token = Cookies.get('Access-Token');

    if (token.length == 0) {
        alert()
        window.location.href = '/auth/login'; 
        return;
    }



    const btnMatchNonProgrammé = document.getElementById('btnMatchNonProgrammé');
    const btnMatchProgrammé = document.getElementById('btnMatchProgrammé');
    const tableMatchProgrammé = document.getElementById('tableMatchProgrammé');
    const tableMatchNonProgrammé = document.getElementById('tableMatchNonProgrammé');

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
    
    addMatchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        
        const journee = document.getElementById('journee').value;
        const equipeLocale = document.getElementById('equipeLocale').value;
        const equipeVisiteuse = document.getElementById('equipeVisiteuse').value;
        
        if (!journee || !equipeLocale || !equipeVisiteuse) {
            alert('Veuillez remplir tous les champs obligatoires.');
            return;
        }
        
        if (equipeLocale === equipeVisiteuse) {
            alert('Les équipes locale et visiteuse ne peuvent pas être identiques.');
            return;
        }
        
        alert('Match ajouté avec succès!');
        modalAddMatch.classList.add('hidden');
        document.body.style.overflow = '';
        addMatchForm.reset();
    });
    
    
    function ouvrirModalProgrammerMatch(idMatch, journee, equipeLocale, equipeVisiteuse) {

        document.getElementById('infoJournee').textContent = 'Journée ' + journee;
        document.getElementById('infoEquipes').textContent = equipeLocale + ' vs ' + equipeVisiteuse;
        

        modalProgrammerMatch.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
   
    document.addEventListener('click', function(e) {
        if (e.target.closest('#tableMatchNonProgrammé button')) {
            ouvrirModalProgrammerMatch('1', '5', 'FC Barcelone', 'Real Madrid');
        }
    });
    
    [closeProgrammerMatchModal, cancelProgrammerMatch].forEach(el => {
        el.addEventListener('click', function() {
            modalProgrammerMatch.classList.add('hidden');
            document.body.style.overflow = '';
        });
    });
    
    programmerMatchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        
        const dateMatch = document.getElementById('dateMatch').value;
        const heureMatch = document.getElementById('heureMatch').value;
        const lieuMatch = document.getElementById('lieuMatch').value;
        
        if (!dateMatch || !heureMatch || !lieuMatch) {
            alert('Veuillez remplir tous les champs obligatoires.');
            return;
        }
        
        alert('Match programmé avec succès!');
        modalProgrammerMatch.classList.add('hidden');
        document.body.style.overflow = '';
        programmerMatchForm.reset();
    });


    
});





document.addEventListener('DOMContentLoaded', async function() {
    await loadMatches(1);
    
    async function loadMatches(page) {
        try {
            const response = await fetch(`/api/match?page=${page}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            console.log(data);
            
            renderMatches(data.matchs.data);
            
            window.renderSimplePagination(data.matchs,loadMatches);
            
        } catch (error) {
            console.error('Erreur lors de la récupération des matchs:', error);
        }
    }
    
    function renderMatches(matches) {
        const tbody = document.querySelector('tbody');
        tbody.innerHTML = ''; 

        matches.forEach(match => {
            const row = `
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${match.date_heure}</div>
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
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        ${match.statut}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">${match.score_domicile} - ${match.score_exterieur}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <div class="flex justify-end space-x-2">
                            <button class="text-indigo-600 hover:text-indigo-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </button>
                            <button class="text-red-600 hover:text-red-900">
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
    }
    
    // function renderSimplePagination(paginationData){
    //     const table = document.querySelector('table');
    //         let paginationContainer = document.getElementById('simple-pagination');
            
    //         if (!paginationContainer) {
    //             paginationContainer = document.createElement('div');
    //             paginationContainer.id = 'simple-pagination';
    //             paginationContainer.className = 'flex justify-center items-center space-x-2 my-4';
    //             table.parentNode.appendChild(paginationContainer);
    //         } else {
    //             paginationContainer.innerHTML = '';
    //         }
            
    //         const currentPage = paginationData.current_page;
    //         const totalPages = paginationData.last_page;
            
    //         // Previous button
    //         const prevButton = document.createElement('button');
    //         prevButton.className = `px-3 py-1 rounded border ${currentPage === 1 ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-indigo-600 hover:bg-indigo-50'}`;
    //         prevButton.innerHTML = 'Prev';
    //         prevButton.disabled = currentPage === 1;
    //         if (currentPage !== 1) {
    //             prevButton.addEventListener('click', () => loadMatches(currentPage - 1));
    //         }
    //         paginationContainer.appendChild(prevButton);
            
    //         // Page numbers (show up to 5 pages)
    //         const maxVisiblePages = 5;
    //         let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    //         let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
            
    //         if (endPage - startPage + 1 < maxVisiblePages) {
    //             startPage = Math.max(1, endPage - maxVisiblePages + 1);
    //         }
            
    //         for (let i = startPage; i <= endPage; i++) {
    //             const pageButton = document.createElement('button');
    //             pageButton.className = `px-3 py-1 rounded border ${i === currentPage ? 'bg-indigo-600 text-white' : 'bg-white text-indigo-600 hover:bg-indigo-50'}`;
    //             pageButton.innerHTML = i;
    //             pageButton.addEventListener('click', () => loadMatches(i));
    //             paginationContainer.appendChild(pageButton);
    //         }
            
    //         // Next button
    //         const nextButton = document.createElement('button');
    //         nextButton.className = `px-3 py-1 rounded border ${currentPage === totalPages ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-indigo-600 hover:bg-indigo-50'}`;
    //         nextButton.innerHTML = 'Next';
    //         nextButton.disabled = currentPage === totalPages;
    //         if (currentPage !== totalPages) {
    //             nextButton.addEventListener('click', () => loadMatches(currentPage + 1));
    //         }
    //         paginationContainer.appendChild(nextButton);
            
    //         // Add pagination info
    //         const infoText = document.createElement('div');
    //         infoText.className = 'text-sm text-gray-500 ml-4';
    //         infoText.innerHTML = `Page ${currentPage} of ${totalPages}`;
    //         paginationContainer.appendChild(infoText);
    //     }
});

