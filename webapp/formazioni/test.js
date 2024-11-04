

// Estrai il nome dell'owner dall'URL
const owner = window.location.pathname.split('/').pop().replace('.php', '');

// Imposta il valore dell'input nascosto
document.getElementById('owner').value = owner;

let selectedPlayers = {};  // Oggetto per memorizzare i giocatori selezionati

function createFormation() {
    const formationDiv = document.getElementById('formation');

    // Pulisci la formazione corrente
    formationDiv.innerHTML = '';

    // Aggiungi 5 pallini per i giocatori
    for (let i = 0; i < 5; i++) {
        const playerDiv = document.createElement('div');
        playerDiv.className = 'player';
        playerDiv.textContent = 'Pallino'; // Testo generico per i pallini
        playerDiv.dataset.index = i;
        playerDiv.onclick = () => selectPlayer(i);
        formationDiv.appendChild(playerDiv);
    }
}

function selectPlayer(index) {
    const owner = document.getElementById('owner').value; // Ottieni il nome dell'owner dall'input nascosto
    fetch('fetch_players_bench.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `owner=${owner}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        displayPlayers(data, index);
    })
    .catch(error => console.error('Errore:', error));
}

function displayPlayers(players, index) {
    const playersList = document.getElementById('playersList');
    playersList.innerHTML = '';  // Pulisci la lista precedente

    players.forEach(player => {
        const playerDiv = document.createElement('div');
        playerDiv.className = 'player-card';
        playerDiv.textContent = `${player.name}`;
        playerDiv.onclick = () => selectPlayerName(player, index);
        playersList.appendChild(playerDiv);
    });
}

function selectPlayerName(player, index) {
    selectedPlayers[index] = {
        player_id: player.id,
        player_name: player.name  // Include il nome del giocatore
    };

    // Aggiorna il pallino con il nome del giocatore selezionato
    const formationDiv = document.getElementById('formation');
    const playerDiv = formationDiv.querySelector(`.player[data-index='${index}']`);
    playerDiv.textContent = `${player.name}`;
}

function saveFormation() {
    const owner = document.getElementById('owner').value;
    const idGiornata = document.getElementById('id_giornata').value;
    const formationArray = Object.values(selectedPlayers);

    // Aggiungi id_giornata a ogni giocatore nella formazione
    formationArray.forEach(player => {
        player.id_giornata = idGiornata;
    });

    const dataToSend = JSON.stringify({
        owner: owner,
        formation: formationArray
    });

    console.log("Data to send:", dataToSend); // Log dei dati da inviare per debug

    fetch('save_formation.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: dataToSend
    })
    .then(response => {
        return response.json().then(data => ({ status: response.status, body: data })); // Parse JSON e ottieni lo status
    })
    .then(({ status, body }) => {
        if (status >= 400) {
            throw new Error(`HTTP error! status: ${status}, message: ${body.error || 'Unknown error'}`);
        }
        console.log('Formazione salvata con successo:', body);
        displayTitolari(formationArray);

        window.location.href = `https://fantaeuropei.netsons.org/webapp/${owner}.php`;
    })
    .catch(error => console.error('Errore nel salvataggio della formazione:', error));
}

function displayTitolari(titolari) {
    const titolariList = document.getElementById('titolariList');
    titolariList.innerHTML = '';  // Pulisci la lista precedente

    titolari.forEach(titolare => {
        const titolareDiv = document.createElement('div');
        titolareDiv.className = 'titolare';
        titolareDiv.textContent = `Nome: ${titolare.player_name}`;
        titolariList.appendChild(titolareDiv);
    });
}

// Inizializza la formazione di default
window.onload = createFormation;
