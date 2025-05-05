




const matchSelect = document.getElementById("matchSelect");
const token = localStorage.getItem('token');
        
let game_id = 0;
let equipe_domicile = 0;
let equipe_exterieur = 0;
        
async function loadMatchs() {
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/game/arbitre`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,  
                'Accept': 'application/json',  
            }
        });
        const result = await response.json();
        console.log(result);
        game_id = result.matchs[0].id;
        equipe_exterieur = result.matchs[0].equipe_exterieur_id;
        equipe_domicile = result.matchs[0].equipe_domicile_id;
        console.log(game_id, equipe_domicile, equipe_exterieur);
        if (result.status === "success" && Array.isArray(result.matchs)) {
            result.matchs.forEach(match => {
                const option = document.createElement("option");
                option.value = match.id;                    
                option.textContent = `${match.equipe_domicile.nom} vs ${match.equipe_exterieur.nom}`;
                matchSelect.appendChild(option);
            });
        } else {
            console.error("Aucun match trouvé.");
        }
    } catch (error) {
        console.error("Erreur lors du chargement des matchs :", error);
    }
}

async function fetchPlayers(homeTeamId, awayTeamId) {
    const teamHomeChangesOut = document.getElementById('teamHomeChangesOut');
    const teamHomeChangesIn = document.getElementById('teamHomeChangesIn');
    const teamAwayChangesOut = document.getElementById('teamAwayChangesOut');
    const teamAwayChangesIn = document.getElementById('teamAwayChangesIn');
    const teamHomeInjury = document.getElementById('teamHomeInjury');
    const teamAwayInjury = document.getElementById('teamAwayInjury');
    const teamHomeSanction = document.getElementById('teamHomeSanction');
    const teamAwaySanction = document.getElementById('teamAwaySanction');
    const teamAwayGoal = document.getElementById('teamAwayGoal');
    const teamHomeGoal = document.getElementById('teamHomeGoal');

    try {
        const response = await fetch(`http://127.0.0.1:8000/api/equipe/${homeTeamId}/liste`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
            }
        });
        const result = await response.json();
        
        const joueurs = result.list.data;
        console.log(joueurs);  

        joueurs.forEach(joueur => {
            const optionText = joueur.user.nom + ' ' + joueur.user.prenom;
            const optionValue = joueur.id;

            const createOption = () => {
                const option = document.createElement("option");
                option.value = optionValue;
                option.textContent = optionText;
                return option;
            };

            // teamHomeInjury.appendChild(createOption());
            teamHomeGoal.appendChild(createOption());
            teamHomeSanction.appendChild(createOption());
            teamHomeChangesIn.appendChild(createOption());
            teamHomeChangesOut.appendChild(createOption());
        });
    } catch (error) {
        console.error("Erreur lors de la récupération des joueurs:", error);
    }

    try {
        const response = await fetch(`http://127.0.0.1:8000/api/equipe/${awayTeamId}/liste`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
            }
        });
        const result = await response.json();
        
        const joueurs = result.list.data;
        console.log(joueurs);  

        joueurs.forEach(joueur => {
            const optionText = joueur.user.nom + ' ' + joueur.user.prenom;
            const optionValue = joueur.id;

            const createOption = () => {
                const option = document.createElement("option");
                option.value = optionValue;
                option.textContent = optionText;
                return option;
            };

            // teamAwayInjury.appendChild(createOption());
            teamAwayGoal.appendChild(createOption());
            teamAwaySanction.appendChild(createOption());
            teamAwayChangesIn.appendChild(createOption());
            teamAwayChangesOut.appendChild(createOption());
        });
    } catch (error) {
        console.error("Erreur lors de la récupération des joueurs:", error);
    }
}

async function sendEvent(url, data) {
    try {
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "Authorization": `Bearer ${token}`
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        if (response.ok) {
            alert("Événement ajouté !");
        } else {
            console.error("Erreur API :", result);
            alert("Erreur lors de l'ajout.");
        }
    } catch (err) {
        console.error("Erreur réseau :", err);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("#teamHomeGoal").parentElement.querySelector("button").addEventListener("click", async (e) => {
        e.preventDefault();
        const joueurId = document.getElementById("teamHomeGoal").value;
        const minute = document.getElementById("teamHomeGoal").parentElement.querySelector("input").value;

        await sendEvent("/api/buteurs", {
            joueur_id: joueurId,
            minute: minute,
            game_id: game_id,
            type: "POST",
            equipe: "domicile"
        });
    });

    document.querySelector("#teamAwayGoal").parentElement.querySelector("button").addEventListener("click", async (e) => {
        e.preventDefault();
        const joueurId = document.getElementById("teamAwayGoal").value;
        const minute = document.getElementById("teamAwayGoal").parentElement.querySelector("input").value;

        await sendEvent("/api/buteurs", {
            joueur_id: joueurId,
            minute: minute,
            game_id: game_id,
            type: "POST",
        });
    });

    document.querySelector("#teamHomeSanction").parentElement.querySelector("button").addEventListener("click", async (e) => {
        e.preventDefault();
        const joueurId = document.getElementById("teamHomeSanction").value;
        const minute = document.getElementById("teamHomeSanction").parentElement.querySelector("input").value;
        const typeSanction = document.getElementById("teamHomeCarton").value;
        const date = new Date();
        const onlyDate = date.toISOString().split('T')[0];

        await sendEvent("/api/sanction", {
            joueur_id: joueurId,
            type: typeSanction,
            date_time: onlyDate,
            game_id: game_id,
            minute: minute,
        });
    });

    document.querySelector("#teamAwaySanction").parentElement.querySelector("button").addEventListener("click", async (e) => {
        e.preventDefault();
        const joueurId = document.getElementById("teamAwaySanction").value;
        const minute = document.getElementById("teamAwaySanction").parentElement.querySelector("input").value;
        const typeSanction = document.getElementById("teamAwayCarton").value;
        const date = new Date();
        const onlyDate = date.toISOString().split('T')[0];

        await sendEvent("/api/sanction", {
            joueur_id: joueurId,
            type: typeSanction,
            date_time: onlyDate,
            game_id: game_id,
            minute: minute,
        });
    });

    document.querySelector("#teamHomeChangesIn").parentElement.querySelector("button")
        .addEventListener("click", async (e) => {
            e.preventDefault();

            const joueur_entreée = document.getElementById("teamHomeChangesIn").value;
            const joueur_sortie = document.getElementById("teamHomeChangesOut").value;
            const minute = document.getElementById("teamHomeChangesIn").parentElement.querySelector("input").value;

            await sendEvent("http://127.0.0.1:8000/api/changements", {
                joueur_entreée_id: joueur_entreée,
                joueur_sortie_id: joueur_sortie,
                equipe_id: equipe_domicile,
                game_id: game_id,
                minute: minute,
            });
        });

    document.querySelector("#teamAwayChangesIn").parentElement.querySelector("button")
        .addEventListener("click", async (e) => {
            e.preventDefault();

            const joueur_entreée = document.getElementById("teamAwayChangesIn").value;
            const joueur_sortie = document.getElementById("teamAwayChangesOut").value;
            const minute = document.getElementById("teamAwayChangesIn").parentElement.querySelector("input").value;

            await sendEvent("http://127.0.0.1:8000/api/changements", {
                joueur_entreée_id: joueur_entreée,
                joueur_sortie_id: joueur_sortie,
                equipe_id: equipe_exterieur,
                game_id: game_id,
                minute: minute,
            });
        });
});

document.getElementById('rapportForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const selectedGameId = form.game_id.value;

    const formRapportData = {
        game_id: selectedGameId,
        reserves: form.reserves.value,
        observations: form.notes.value
    };

    const formScoreData = {
        score_domicile: form.score_domicile.value,
        score_exterieur: form.score_exterieur.value,
        statut: 'terminé',
    };

    try {
        const rapportResponse = await fetch('http://127.0.0.1:8000/api/rapports', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
            body: JSON.stringify(formRapportData)
        });

        const rapportResult = await rapportResponse.json();
        
        const scoreResponse = await fetch(`http://127.0.0.1:8000/api/game/${selectedGameId}/score`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
            body: JSON.stringify(formScoreData)
        });

        const scoreResult = await scoreResponse.json();
        
        if (rapportResponse.ok && scoreResponse.ok) {
            alert("Rapport envoyé avec succès !");
            
            downloadRapportPDF(selectedGameId);
            
            form.reset();
        } else {
            alert("Erreur : " + (rapportResult.message || scoreResult.message || "Échec de l'envoi"));
        }
    } catch (error) {
        console.error("Erreur de requête :", error);
        alert("Une erreur est survenue.");
    }
});

async function downloadRapportPDF(gameId) {
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/rapports/${gameId}/pdf?token=${token}`);

        if (!response.ok) {
            throw new Error("Erreur serveur");
        }

        const blob = await response.blob();

        const url = window.URL.createObjectURL(blob);

        const a = document.createElement('a');
        a.href = url;
        a.download = `rapport_match_journee_${gameId}.pdf`; 
        document.body.appendChild(a);
        a.click(); 
        a.remove();


        

        window.URL.revokeObjectURL(url);

    } catch (error) {
        console.error("Erreur lors du téléchargement du rapport :", error);
        alert("Impossible de télécharger le rapport PDF.");
    }
}

window.addEventListener("DOMContentLoaded", async () => {
    await loadMatchs();
    await fetchPlayers(equipe_domicile, equipe_exterieur);
});